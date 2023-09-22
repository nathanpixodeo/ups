<?php
/**
 * Package file
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
namespace UPS\Shipping\Model;

use Magento\Eav\Model\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ObjectManager;
use stdClass;

/**
 * Package class
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
class PackageDimension
{
    public $pkgLength = 0;
    public $pkgWidth  = 0;
    public $pkgHeight = 0;
    public $dimensionUnit = 'cm';
    public $pkgWeight = 0;
    public $numberOfPackage = 1;
    public $weightUnit = 'kgs';
    public $description = '';

    private $numberOfCartItem = 0;
    private $isIncludeDimension = false;
    private $isCompatibleWeight = false;
    private $isCompatibleDimension = false;
    private $cartPackage;
    private $smallestBox;
    private $heaviestBox;
    private $cartProducts = [];
    private $listDefaultPackage = [];
    private $listProductDimension = [];

    const TYPE_PACKAGE_DEFAULT = 1;
    const TYPE_PRODUCT_DIMENSION = 2;

    protected $modelPackageDefault;
    protected $modelProductDimension;
    protected $scopeConfig;
    protected $checkoutSession;
    protected $storeManager;
    protected $_logger;
    protected $weightBased;
    protected $BoxBased;

    /**
     * Place __construct
     *
     * @param \Psr\Log\LoggerInterface $logger
     * @param Package $modelPackageDefault //The openOrderModel
     * @param Package $modelProductDimension //The checkoutSession
     * @param ScopeConfigInterface $scopeConfig //The scopeConfig
     * @param CartInterface $cart //The modelService
     * @param Config $config //The modelAccessorial
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \UPS\Shipping\Model\Package $modelPackageDefault,
        \UPS\Shipping\Model\Dimension $modelProductDimension,
        ScopeConfigInterface $scopeConfig,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \UPS\Shipping\Model\WeightBased\WeightPack $weightBased,
        \UPS\Shipping\Model\BoxBased\BoxPack $BoxBased
    ) {
        $this->_logger = $logger;
        $this->modelPackageDefault = $modelPackageDefault;
        $this->modelProductDimension = $modelProductDimension;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->checkoutSession = $checkoutSession;
        $this->weightBased = $weightBased;
        $this->BoxBased = $BoxBased;
    }


    /**
     * PackageDimension getShippingPackage
     *
     * @return array $data
     */
    public function getShippingPackage()
    {
        // $this->weightUnit = $this->storeManager->getStore()->getConfig('general/locale/weight_unit');
        // if ($this->weightUnit == 'lbs') {
        //     $this->dimensionUnit = 'inch';
        // }
        $this->weightUnit = 'kgs';
        $this->dimensionUnit = 'cm';
        $packageSettingType = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_PACKAGE_DIMENSIONS);
        $this->_logger->debug("packageSettingType: " . $packageSettingType);
        $includeDimension = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_INCLUDE_DIMENSIONS) == 1 ? true : false;
        $this->_logger->debug("includeDimension: " . print_r($includeDimension, true));
        $listPackages = [];

        if ($packageSettingType == false || $packageSettingType == self::TYPE_PACKAGE_DEFAULT) {
            // Get list default package
            $listDefaultPackage = $this->modelPackageDefault->getListPackage();
            $numberOfCartItem = $this->checkoutSession->getQuote()->getItemsQty();

            // Set package dimension (case package default)
            $this->setDefaultPackageDimension($listDefaultPackage, $numberOfCartItem);
            for ($i = 1; $i <= $this->numberOfPackage; $i++) {
                $package = [];
                $package['length'] = strval($this->pkgLength);
                $package['width'] = strval($this->pkgWidth);
                $package['height'] = strval($this->pkgHeight);
                $package['unit_dimension'] = $this->dimensionUnit;
                $package['weight'] = strval($this->pkgWeight);
                $package['unit_weight'] = $this->weightUnit;
                $listPackages[] = $package;
            }
        } elseif ($packageSettingType == self::TYPE_PRODUCT_DIMENSION) {
            $isIncludeDimension = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_INCLUDE_DIMENSIONS) == 1 ? true : false;
            $listProductDimension = $this->modelProductDimension->getListDimension();
            $this->_logger->debug("includeDimension: " . print_r($isIncludeDimension, true));
            $this->_logger->debug("getListPackage: " . print_r($listProductDimension, true));
            // Get products from cart
            // $cartProducts = $this->checkoutSession->getQuote()->getAllItems();
            $cartProducts = $this->checkoutSession->getQuote()->getItems();
            // $cartProducts = $this->checkoutSession->getQuote()->getAllVisibleItems();
            // $order_currency = $this->checkoutSession->getQuote()->getQuoteCurrencyCode();
            $filteredItems = [];
            if (!empty($cartProducts)) {
                foreach ($cartProducts as $product) {
                // Get product info
                    if ($product->getHasChildren()) {
                        foreach ($product->getChildren() as $child) {
                            $child_length = $child->getProduct()->getData('ups_dimensions_length');
                            $child_width = $child->getProduct()->getData('ups_dimensions_width');
                            $child_height = $child->getProduct()->getData('ups_dimensions_height');
                            $child_weight = ($child->getIsVirtual() == 1 || $child->getProduct()->getTypeId() != 'simple') ? 0.5 : $child->getWeight();
                            $item_price = $child->getPrice();
                            if (empty($item_price) || $item_price <= 0) {
                                $item_price = $child->getProduct()->getFinalPrice();
                            }
                            $filteredItems[] = [
                                'id_product' => $child->getProductId(),
                                'name' => $child->getName(),
                                'quantity' => $product->getQty(),
                                'length' => (!empty($child_length) && $child_length > 0) ? round($this->get_dimension($child_length, "cm"), 4) : 0.5,
                                'width' => (!empty($child_width) && $child_width > 0) ? round($this->get_dimension($child_width, "cm"), 4) : 0.5,
                                'height' => (!empty($child_height) && $child_height > 0) ? round($this->get_dimension($child_height, "cm"), 4) : 0.5,
                                'weight' => (!empty($child_weight) && $child_weight > 0) ? round($this->get_weight($child_weight, "kgs"), 4) : 0.5,
                                'price' => $item_price
                            ];
                        }
                    } else {
                        $prod_length = $product->getProduct()->getData('ups_dimensions_length');
                        $prod_width = $product->getProduct()->getData('ups_dimensions_width');
                        $prod_height = $product->getProduct()->getData('ups_dimensions_height');
                        $prod_weight = ($product->getIsVirtual() == 1 || $product->getProduct()->getTypeId() != 'simple') ? 0.5 : $product->getWeight();
                        $item_price = $product->getPrice();
                        if (empty($item_price) || $item_price <= 0) {
                            $item_price = $product->getProduct()->getFinalPrice();
                        }
                        $filteredItems[] = [
                            'id_product' => $product->getProductId(),
                            'name' => $product->getName(),
                            'quantity' => $product->getQty(),
                            'length' => (!empty($prod_length) && $prod_length > 0) ? round($this->get_dimension($prod_length, "cm"), 4) : 0.5,
                            'width' => (!empty($prod_width) && $prod_width > 0) ? round($this->get_dimension($prod_width, "cm"), 4) : 0.5,
                            'height' => (!empty($prod_height) && $prod_height > 0) ? round($this->get_dimension($prod_height, "cm"), 4) : 0.5,
                            'weight' => (!empty($prod_weight) && $prod_weight > 0) ? round($this->get_weight($prod_weight, "kgs"), 4) : 0.5,
                            'price' => $item_price
                        ];
                    }
                }
            }
            $packed_packages = $this->getPackages($filteredItems);
            if (!empty($packed_packages)) {
                $listPackages = $packed_packages;
            }
        }
        
        $this->_logger->debug("listPackages: " . print_r($listPackages, true));

        return $listPackages;
    }

    public function getShippingPackageOrder($order_items)
    {
        // $this->weightUnit = $this->storeManager->getStore()->getConfig('general/locale/weight_unit');
        // if ($this->weightUnit == 'lbs') {
        //     $this->dimensionUnit = 'inch';
        // }
        $this->weightUnit = 'kgs';
        $this->dimensionUnit = 'cm';
        $packageSettingType = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_PACKAGE_DIMENSIONS);
        $this->_logger->debug("packageSettingType: " . $packageSettingType);
        $includeDimension = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_INCLUDE_DIMENSIONS) == 1 ? true : false;
        $this->_logger->debug("includeDimension: " . print_r($includeDimension, true));

        $listPackages = [];
        if ($packageSettingType == false || $packageSettingType == self::TYPE_PACKAGE_DEFAULT) {
            // Get list default package
            $listDefaultPackage = $this->modelPackageDefault->getListPackage();
            $numberOfCartItem = 0;
            foreach ($order_items as $key => $order_item) {
                if ($order_item->getHasChildren()) {
                    continue;
                } else {
                    $numberOfCartItem = $numberOfCartItem + $order_item->getQtyOrdered();
                }
            }
            // Set package dimension (case package default)
            $this->setDefaultPackageDimension($listDefaultPackage, $numberOfCartItem);
            for ($i = 1; $i <= $this->numberOfPackage; $i++) {
                $package = [];
                $package['length'] = strval($this->pkgLength);
                $package['width'] = strval($this->pkgWidth);
                $package['height'] = strval($this->pkgHeight);
                $package['unit_dimension'] = $this->dimensionUnit;
                $package['weight'] = strval($this->pkgWeight);
                $package['unit_weight'] = $this->weightUnit;
                $listPackages[] = $package;
            }
        } elseif ($packageSettingType == self::TYPE_PRODUCT_DIMENSION) {
            $isIncludeDimension = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_INCLUDE_DIMENSIONS) == 1 ? true : false;
            $listProductDimension = $this->modelProductDimension->getListDimension();
            $this->_logger->debug("includeDimension: " . print_r($isIncludeDimension, true));
            $this->_logger->debug("getListPackage: " . print_r($listProductDimension, true));

            $filteredItems = [];
            foreach ($order_items as $product) {
            // Get product info
                if ($product->getHasChildren()) {
                    continue;
                    // foreach ($product->getChildren() as $child) {
                    //     $child_length = $child->getProduct()->getData('ups_dimensions_length');
                    //     $child_width = $child->getProduct()->getData('ups_dimensions_width');
                    //     $child_height = $child->getProduct()->getData('ups_dimensions_height');
                    //     $child_weight = ($child->getIsVirtual() == 1 || $child->getProduct()->getTypeId() != 'simple') ? 0.5 : $child->getWeight();
                    //     $item_price = $child->getPrice();
                    //     if (empty($item_price) || $item_price <= 0) {
                    //         $item_price = $child->getProduct()->getFinalPrice();
                    //     }
                    //     $filteredItems[] = [
                    //         'id_product' => $child->getProductId(),
                    //         'name' => $child->getName(),
                    //         'quantity' => $product->getQtyOrdered(),
                    //         'length' => (!empty($child_length) && $child_length > 0) ? $child_length : 0.5,
                    //         'width' => (!empty($child_width) && $child_width > 0) ? $child_width : 0.5,
                    //         'height' => (!empty($child_height) && $child_height > 0) ? $child_height : 0.5,
                    //         'weight' => (!empty($child_weight) && $child_weight > 0) ? $child_weight : 0.5,
                    //         'price' => $item_price
                    //     ];
                    // }
                } else {
                    $prod_length = $product->getProduct()->getData('ups_dimensions_length');
                    $prod_width = $product->getProduct()->getData('ups_dimensions_width');
                    $prod_height = $product->getProduct()->getData('ups_dimensions_height');
                    $prod_weight = ($product->getIsVirtual() == 1 || $product->getProduct()->getTypeId() != 'simple') ? 0.5 : $product->getWeight();
                    $item_price = $product->getPrice();
                    if (empty($item_price) || $item_price <= 0) {
                        $item_price = $product->getProduct()->getFinalPrice();
                    }
                    $filteredItems[] = [
                        'id_product' => $product->getProductId(),
                        'name' => $product->getName(),
                        'quantity' => $product->getQtyOrdered(),
                        'length' => (!empty($prod_length) && $prod_length > 0) ? round($this->get_dimension($prod_length, "cm"), 4) : 0.5,
                        'width' => (!empty($prod_width) && $prod_width > 0) ? round($this->get_dimension($prod_width, "cm"), 4) : 0.5,
                        'height' => (!empty($prod_height) && $prod_height > 0) ? round($this->get_dimension($prod_height, "cm"), 4) : 0.5,
                        'weight' => (!empty($prod_weight) && $prod_weight > 0) ? round($this->get_weight($prod_weight, "kgs"), 4) : 0.5,
                        'price' => $item_price
                    ];
                }
            }
            $packed_packages = $this->getPackages($filteredItems);
            if (!empty($packed_packages)) {
                $listPackages = $packed_packages;
            }
        }
        $this->_logger->debug("listPackages: " . print_r($listPackages, true));

        return $listPackages;
    }

    public function getPackages($cartProducts)
    {
        $pack_algo = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::SERVICE_UPS_SHIPPING_PACKALGO);

        switch ($pack_algo) {
            case 'IND_PACK':
                return $this->per_item_shipping($cartProducts);
                break;

            case 'WEG_PACK':
                return $this->weight_based_shipping($cartProducts);
                break;
            
            default:
                return $this->box_based_shipping($cartProducts);
                break;
        }
    }

    private function per_item_shipping($cartProducts)
    {
        $to_ship = array();

        $unit_weight = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::SERVICE_UPS_SHIPPING_PACKWEGUNIT);
        $unit_dimension = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::SERVICE_UPS_SHIPPING_PACKDIMUNIT);

        // if ($unit_dimension != $this->dimensionUnit || $unit_weight != $this->weightUnit) {
        //     return $to_ship;
        // }
        if (empty($cartProducts)) {
            return $to_ship;
        }

        // Get weight of order
        foreach ($cartProducts as $item_id => $product) {
            $group = array();

            if($product['weight'] < 0.001){
                $per_item_weight = 0.001;
            }else{
                $per_item_weight = round($product['weight'], 3);
            }
            $group['weight'] = strval($per_item_weight);
            $group['length'] = strval(round($product['length'],3));
            $group['width'] = strval(round($product['width'],3));
            $group['height'] = strval(round($product['height'],3));
            $group['unit_weight'] = $this->weightUnit;
            $group['unit_dimension'] = $this->dimensionUnit;

            $chk_qty = $product['quantity'];

            for ($i = 0; $i < $chk_qty; $i++)
            $to_ship[] = $group;
        }
        return $to_ship;
    }

    private function weight_based_shipping($cartProducts)
    {
        $to_ship  = [];
        $unit_weight = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::SERVICE_UPS_SHIPPING_PACKWEGUNIT);
        $maxWeg = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::SERVICE_UPS_SHIPPING_PACKMAXWEG);
        // if ($unit_weight != $this->weightUnit) {
        //     return $to_ship;
        // }
        if (empty($cartProducts)) {
            return $to_ship;
        }
        $weight_pack = new \UPS\Shipping\Model\WeightBased\WeightPack();
        $weight_pack->_init("pack_descending");
        if (empty($maxWeg)) {
            $weight_pack->set_max_weight('10');
        } else {
            $weight_pack->set_max_weight($maxWeg);
        }

        foreach ($cartProducts as $item_id => $values) {
            if (!$values['weight']) {
                return;
            }
            $chk_qty = $values['quantity'];

            $weight_pack->add_item($values['weight'], $values, $chk_qty);
        }

        $pack   =   $weight_pack->pack_items();
        $errors =   $pack->get_errors();

        if (!empty($errors)) {
            //do nothing
            return;
        } else {
            $boxes    =   $pack->get_packed_boxes();
            $unpacked_items =   $pack->get_unpacked_items();

            $packages      =   array_merge($boxes, $unpacked_items); // merge items if unpacked are allowed

            foreach ($packages as $package) {
                $group['weight'] = strval(round($package['weight'],3));
                $group['unit_weight'] = $this->weightUnit;
                $to_ship[] = $group;
            }
        }
        return $to_ship;
    }

    private function box_based_shipping($cartProducts)
    {
        $to_ship = [];
        $isIncludeDimension = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_INCLUDE_DIMENSIONS) == 1 ? true : false;
        $all_saved_boxes = $this->modelProductDimension->getListDimension();
        $this->_logger->debug("includeDimension: " . print_r($isIncludeDimension, true));
        $this->_logger->debug("getListPackage: " . print_r($all_saved_boxes, true));
        // $all_saved_boxes = $model_product_dimension->ups_eu_woo_get_all();
        if (empty($cartProducts)) {
            return $to_ship;
        }
        if (empty($all_saved_boxes)) {
            return;
        }
        $packer = $this->BoxBased;
        foreach ($all_saved_boxes as $box) {
            // if (!isset($box['unit_weight']) || !isset($box['unit_dimension']) || $box['unit_dimension'] != $this->dimensionUnit || $box['unit_weight'] != $this->weightUnit) {
            //     continue;
            // }
            if (!isset($box['length']) || !isset($box['width']) || !isset($box['height']) || !isset($box['package_id']) || !isset($box['weight'])) {
                continue;
            }
            $packer->add_box( $box['length'], $box['width'], $box['height'], $box['weight'], $box['package_id'] );
        }

        foreach ($cartProducts as $c_key => $product) {
            if (!empty($product)) {
                $product_name = isset($product['name']) ? $product['name'] : $c_key;
                $product_price = isset($product['price']) ? $product['price'] : 0;
                $product_length = isset($product['length']) ? $product['length'] : 0.5;
                $product_width  = isset($product['width']) ? $product['width'] : 0.5;
                $product_height = isset($product['height']) ? $product['height'] : 0.5;
                $product_weight = isset($product['weight']) ? $product['weight'] : 0.5;
                $product_quantity = isset($product['quantity']) ? $product['quantity'] : 0;
                for ($i=0; $i < $product_quantity; $i++) {
                    // length, width, heoght, weight, price, meta data
                    $packer->add_item($product_length, $product_width, $product_height, $product_weight, $product_price, array($product_name, $product_price, $product_length, $product_width, $product_height, $product_weight));
                }
            }
        }

        $packer->pack();
        $packedBoxes = $packer->get_packages();
        // $unpackedItems = $packer->getUnpackedItems();
        foreach ($packedBoxes as $key => $p_b) {
            $group['weight'] = strval(round($p_b->weight,3));
            $group['length'] = strval(round($p_b->length,3));
            $group['width'] = strval(round($p_b->width,3));
            $group['height'] = strval(round($p_b->height,3));
            $group['unit_weight'] = $this->weightUnit;
            $group['unit_dimension'] = $this->dimensionUnit;
            $to_ship[] = $group;
        }
        return $to_ship;
    }

    /**
     * setDefaultPackageDimension
     *
     * @param array $listDefaultPackage : list default package
     * @param int $numberOfCartItem : number of item in cart
     */
    public function setDefaultPackageDimension($listDefaultPackage, $numberOfCartItem)
    {
        // Set variable
        $this->listDefaultPackage = $listDefaultPackage;
        $this->numberOfCartItem = $numberOfCartItem;
        // Check empty array data
        if (empty($this->listDefaultPackage)) {
            return;
        }
        $packageIndex = 0;
        $numberOfItem = 1;
        // Set package index (get max setting number < cart number)
        foreach ($this->listDefaultPackage as $key => $defaultPackage) {
            if ($defaultPackage['unit_dimension'] != $this->dimensionUnit || $defaultPackage['unit_weight'] != $this->weightUnit) {
                continue;
            }
            if ($defaultPackage['package_number'] <= $numberOfCartItem && $numberOfItem <= $defaultPackage['package_number']) {
                $packageIndex = $key;
                $numberOfItem = $defaultPackage['package_number'];
            }
        }
        // Set package dimension
        $this->pkgLength = $this->listDefaultPackage[$packageIndex]['length'];
        $this->pkgWidth  = $this->listDefaultPackage[$packageIndex]['width'];
        $this->pkgHeight = $this->listDefaultPackage[$packageIndex]['height'];
        $this->pkgWeight = $this->listDefaultPackage[$packageIndex]['weight'];
        $this->description = 'Get default package dimension';
    }
    private function get_weight( $weight, $to_unit, $from_unit = '' ) {
        $weight  = (float) $weight;
        $to_unit = strtolower( $to_unit );

        if ( empty( $from_unit ) ) {
            $from_unit = $this->storeManager->getStore()->getConfig('general/locale/weight_unit');
        }

        // Unify all units to kg first.
        if ( $from_unit !== $to_unit ) {
            switch ( $from_unit ) {
                case 'g':
                    $weight *= 0.001;
                    break;
                case 'gms':
                    $weight *= 0.001;
                    break;
                case 'lbs':
                    $weight *= 0.453592;
                    break;
                case 'oz':
                    $weight *= 0.0283495;
                    break;
            }

            // Output desired unit.
            switch ( $to_unit ) {
                case 'g':
                    $weight *= 1000;
                    break;
                case 'gms': //Unit from Extended weight unit module
                    $weight *= 1000;
                    break;
                case 'lbs':
                    $weight *= 2.20462;
                    break;
                case 'oz':
                    $weight *= 35.274;
                    break;
            }
        }

        return ( $weight < 0 ) ? 0.5 : $weight;
    }
    private function get_dimension( $dimension, $to_unit, $from_unit = '' ) {
        $to_unit = strtolower( $to_unit );

        if ( empty( $from_unit ) ) {
            $magWegUnit = $this->storeManager->getStore()->getConfig('general/locale/weight_unit');
            $from_unit = (strtolower($magWegUnit) == "lb" || strtolower($magWegUnit) == "lbs") ? 'inch' : 'cm';
        }

        // Unify all units to cm first.
        if ( $from_unit !== $to_unit ) {
            switch ( $from_unit ) {
                case 'in':
                    $dimension *= 2.54;
                    break;
                case 'inch':
                    $dimension *= 2.54;
                    break;
                case 'm':
                    $dimension *= 100;
                    break;
                case 'mm':
                    $dimension *= 0.1;
                    break;
                case 'yd':
                    $dimension *= 91.44;
                    break;
            }

            // Output desired unit.
            switch ( $to_unit ) {
                case 'in':
                    $dimension *= 0.3937;
                    break;
                case 'inch':
                    $dimension *= 0.3937;
                    break;
                case 'm':
                    $dimension *= 0.01;
                    break;
                case 'mm':
                    $dimension *= 10;
                    break;
                case 'yd':
                    $dimension *= 0.010936133;
                    break;
            }
        }

        return ( $dimension < 0 ) ? 0.5 : $dimension;
    }
}
