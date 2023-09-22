<?php
/**
 * Place file
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
namespace UPS\Shipping\Plugin\Order;

/**
 * Place class
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
class Place
{
    protected $openOrder;
    protected $checkoutSession;
    protected $salesOrder;
    protected $modelService;
    protected $modelAccessorial;
    protected $scopeConfig;

    /**
     * Place __construct
     *
     * @param string $openOrderModel   //The openOrderModel
     * @param string $checkoutSession  //The checkoutSession
     * @param string $salesOrder       //The salesOrder
     * @param string $modelService     //The modelService
     * @param string $modelAccessorial //The modelAccessorial
     *
     * @return null
     */
    public function __construct(
        \UPS\Shipping\Model\Order $openOrderModel,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\Order $salesOrder,
        \UPS\Shipping\Model\Service $modelService,
        \UPS\Shipping\Model\Accessorial $modelAccessorial,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->openOrder = $openOrderModel;
        $this->checkoutSession = $checkoutSession;
        $this->salesOrder = $salesOrder;
        $this->modelService = $modelService;
        $this->modelAccessorial = $modelAccessorial;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Place afterPlaceOrder
     *
     * @param string $subject //The subject
     * @param array  $result  //The result
     *
     * @return array $data
     */
    public function afterPlaceOrder(\Magento\Quote\Model\QuoteManagement $subject, $result)
    {
        $checkoutSessionData = $this->checkoutSession->getData();
        $salesOrder = $this->salesOrder->load($checkoutSessionData['last_order_id']);
        $ups_f = true;
        if (($salesOrder->getShippingMethod() == \UPS\Shipping\Helper\Config::SALES_ORDER_SHIPPING_METHOD) || ($ups_f == true)) {
            $shippingService = $this->checkoutSession->getSelectedShippingService();
            if ($salesOrder->getShippingMethod() != \UPS\Shipping\Helper\Config::SALES_ORDER_SHIPPING_METHOD) {
                $shippingService = 0;
            }
            //check Saturday Delivery Service
            $service = $this->modelService->getServicesById($shippingService);
            $satDeliFlg = false;
            if (!empty($service) && strpos($service[0]['service_key'], 'SAT_DELI') !== false) {
                $satDeliFlg = true;
            }
            $listAccessorials = $this->modelAccessorial->getListAccessorialActive($satDeliFlg);

            $selectedAPAddress = $this->checkoutSession->getSelectedAPAddress();
            $selectedAddress = (!empty($selectedAPAddress)) ? $selectedAPAddress : '';
            $listServices = $this->modelService->getServicesById($shippingService);
            if (isset($listServices[0]['service_type'])
                && $listServices[0]['service_type'] == 'AP'
                && !empty($selectedAddress)
            ) {
                $arrSelectedAddress = json_decode($selectedAddress);
                $ap_id = isset($arrSelectedAddress->AccessPointId)
                ? $arrSelectedAddress->AccessPointId : '';
                $ap_name = isset($arrSelectedAddress->ConsigneeName)
                ? $arrSelectedAddress->ConsigneeName : '';
                $ap_address1 = isset($arrSelectedAddress->AddressLine)
                ? base64_decode($arrSelectedAddress->AddressLine) : '';
                $ap_address2 = '';
                $ap_city = isset($arrSelectedAddress->PoliticalDivision2)
                ? $arrSelectedAddress->PoliticalDivision2 : '';
                $ap_postcode = isset($arrSelectedAddress->PostcodePrimaryLow)
                ? $arrSelectedAddress->PostcodePrimaryLow : '';
                $ap_state = isset($arrSelectedAddress->PoliticalDivision1)
                ? $arrSelectedAddress->PoliticalDivision1 : '';

                // $apAsShipToString = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::SERVICE_UPS_SHIPPING_DELIVERY_SET_AP_AS_SHIP);
                // if (!empty($apAsShipToString) && ($apAsShipToString == 1)) {
                //     $ap_data = [
                //         'region_id' => '',
                //         'region' => $ap_state,
                //         'postcode' => $ap_postcode,
                //         'lastname' => '',
                //         'street' => $ap_address1,
                //         'city' => $ap_city,
                //         'firstname' => $ap_name,
                //         'company' => ''
                //     ];
                //     $arrWhere = [
                //         'parent_id = ?' => $checkoutSessionData['last_order_id'],
                //         'address_type = ?' => 'shipping'
                //     ];
                //     $this->openOrder->updateAPaddr($ap_data, $arrWhere);
                // }
            } else {
                $ap_id = '';
                $ap_name = '';
                $ap_address1 = '';
                $ap_address2 = '';
                $ap_city = '';
                $ap_postcode = '';
                $ap_state = '';
            }
            // Get package dimension for shipping
            $packageDimension = $this->checkoutSession->getPackageDimension();
            // Get customer delivery address if available
            $cusDelAddr = $this->checkoutSession->getCusDelAddress();
            // Set open order data
            $openOrder = [
                'order_id_magento' => $checkoutSessionData['last_order_id'],
                'shipping_service' => $shippingService,
                'accessorial_service' => $listAccessorials,
                'package' => $packageDimension,
                'shipment_id' => 0,
                'quote_id' => $checkoutSessionData['last_quote_id'],
                'status' => 1,
                'ap_id' => $ap_id,
                'ap_name' => $ap_name,
                'ap_address1' => $ap_address1,
                'ap_address2' => $ap_address2,
                'ap_state' => $ap_state,
                'ap_postcode' => $ap_postcode,
                'ap_city' => $ap_city,
                'ap_country' => '',
                'cod' => '',
                'created_at' => date("Y-m-d"),
                'cus_del_name' => (isset($cusDelAddr['name']) && !empty($cusDelAddr['name'])) ? $cusDelAddr['name'] : "",
                'cus_del_address1' => (isset($cusDelAddr['street'][0]) && !empty($cusDelAddr['street'][0])) ? $cusDelAddr['street'][0] : "",
                'cus_del_address2' => (isset($cusDelAddr['street'][1]) && !empty($cusDelAddr['street'][1])) ? $cusDelAddr['street'][1] : "",
                'cus_del_city' => (isset($cusDelAddr['city']) && !empty($cusDelAddr['city'])) ? $cusDelAddr['city'] : "",
                'cus_del_state' => (isset($cusDelAddr['state']) && !empty($cusDelAddr['state'])) ? $cusDelAddr['state'] : "",
                'cus_del_postcode' => (isset($cusDelAddr['zip']) && !empty($cusDelAddr['zip'])) ? $cusDelAddr['zip'] : "",
                'cus_del_country' => (isset($cusDelAddr['country']) && !empty($cusDelAddr['country'])) ? $cusDelAddr['country'] : ""
            ];
            if ($this->openOrder->insertOpenOrderAfterPlace($openOrder)) {
                $this->checkoutSession->unsCusDelAddress();
                $this->checkoutSession->unsSelectedShippingService();
                $this->checkoutSession->unsSelectedAPAddress();
                $this->checkoutSession->unsSelectedFee();
                $this->checkoutSession->unsCheapestFee();
                $this->checkoutSession->unsListServiceTypes();
                $this->checkoutSession->unsDefaultService();
                $this->checkoutSession->unsEnableServiceAP();
                $this->checkoutSession->unsEnableServiceADD();
                $this->checkoutSession->unsPackageDimension();
                $this->checkoutSession->unsClearSession();
            }
        }
        return $result;
    }
}
