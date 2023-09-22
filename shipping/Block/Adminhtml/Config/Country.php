<?php
/**
 * Country file
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
namespace UPS\Shipping\Block\Adminhtml\Config;

/**
 * Country class
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
class Country extends \Magento\Framework\View\Element\Template
{
    private $_value = 'value';
    protected $scopeConfig;
    protected $country;
    protected $formKey;
    protected $apiHandshake;
    protected $cacheTypeList;
    protected $checkoutSession;
    protected $maintenanceMode;
    protected $storeManager;

    /**
     * Country __construct
     *
     * @param string $context         //The context
     * @param string $country         //The country
     * @param string $apiHandshake    //The apiHandshake
     * @param string $configWriter    //The configWriter
     * @param string $cacheTypeList   //The cacheTypeList
     * @param string $formKey         //The formKey
     * @param string $checkoutSession //The checkoutSession
     *
     * @return null
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Directory\Model\Config\Source\Country $country,
        \UPS\Shipping\API\Handshake $apiHandshake,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Framework\App\MaintenanceMode $maintenanceMode,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Checkout\Model\Session $checkoutSession
    ) {
        $this->scopeConfig = $context->getScopeConfig();
        $this->country = $country;
        $this->formKey = $formKey;
        $this->apiHandshake = $apiHandshake;
        $this->configWriter = $configWriter;
        $this->cacheTypeList = $cacheTypeList;
        $this->maintenanceMode = $maintenanceMode;
        $this->storeManager = $storeManager;
        $this->checkoutSession = $checkoutSession;

        parent::__construct($context);
    }

    /**
     * Country isCountryCode
     *
     * @return array $data
     */
    public function isCountryCode()
    {
        return $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_COUNTRY_CODE);
    }

    /**
     * Country getListContry
     *
     * @return array $data
     */
    public function getListContry()
    {
        $this->callAPIHandshake();
        $arrayOptionCountry = $this->country->toOptionArray(true);
        $listCountry = [];
        $arrayCountry = \UPS\Shipping\Helper\Config::LISTEUCOUNTRYS;
        $belgium = (string)__('Belgium');
        $netherlands = (string)__('Netherlands');
        $france = (string)__('France');
        $spain = (string)__('Spain');
        $poland = (string)__('Poland');
        $italy = (string)__('Italy');
        $germany = (string)__('Germany');
        $unitedKingdom = (string)__('United Kingdom');
        $unitedStates = (string)__('United States');
        $austria = (string)__('Austria');
        $bulgaria = (string)__('Bulgaria');
        $croatia = (string)__('Croatia');
        $cyprus = (string)__('Cyprus');
        $czechRepublic = (string)__('CzechRepublic');
        $denmark = (string)__('Denmark');
        $estonia = (string)__('Estonia');
        $finland = (string)__('Finland');
        $greece = (string)__('Greece');
        $hungary = (string)__('Hungary');
        $ireland = (string)__('Ireland');
        $latvia = (string)__('Latvia');
        $lithuania = (string)__('Lithuania');
        $luxembourg = (string)__('Luxembourg');
        $malta = (string)__('Malta');
        $portugal = (string)__('Portugal');
        $romania = (string)__('Romania');
        $slovakia = (string)__('Slovakia');
        $slovenia = (string)__('Slovenia');
        $sweden = (string)__('Sweden');
        $norway = (string)__('Norway');
        $serbia = (string)__('Serbia');
        $switzerland = (string)__('Switzerland');
        $iceland = (string)__('Iceland');
        $jersey = (string)__('Jersey');
        $turkey = (string)__('Turkey');
        $listCountryNames = [
                                'BE'=>$belgium,
                                'NL'=>$netherlands,
                                'FR'=>$france,
                                'ES'=>$spain,
                                'PL'=>$poland,
                                'IT'=>$italy,
                                'DE'=>$germany,
                                'GB'=>$unitedKingdom,
                                'US'=>$unitedStates,
                                'AT'=>$austria,
                                'CZ'=>$czechRepublic,
                                'DK'=>$denmark,
                                'FI'=>$finland,
                                'GR'=>$greece,
                                'HU'=>$hungary,
                                'IE'=>$ireland,
                                'LU'=>$luxembourg,
                                'PT'=>$portugal,
                                'RO'=>$romania,
                                'SI'=>$slovenia,
                                'SE'=>$sweden,
                                'NO'=>$norway,
                                'CH'=>$switzerland,
                                'IS'=>$iceland,
                                'JE'=>$jersey,
                                'TR'=>$turkey,
                                // 'BG'=>$bulgaria,
                                // 'HR'=>$croatia,
                                // 'CY'=>$cyprus,
                                // 'EE'=>$estonia,
                                // 'LV'=>$latvia,
                                // 'LT'=>$lithuania,
                                // 'MT'=>$malta,
                                // 'SK'=>$slovakia,
                                // 'RS'=>$serbia,
                            ];
        foreach ($arrayOptionCountry as $country) {
            if (in_array($country[$this->_value], $arrayCountry)) {
                $arrayCountrys = [
                    'id' => $country[$this->_value],
                    $this->_value => $listCountryNames[$country[$this->_value]]
                ];
                array_push($listCountry, $arrayCountrys);
            }
        }
        return $listCountry;
    }

    /**
     * TermCondition callAPILicense
     *
     * @return array $data
     */
    public function callAPIHandshake()
    {
        $getMerchantKey = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::UPS_MERCHANTKEY);
        $websiteMerchant = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::UPS_WEBSECUREURL);
        $valueSecurityToken = $this->apiHandshake->generatePass(32);
        $this->configWriter->save(\UPS\Shipping\Helper\Config::UPS_SERVICE_LINK_SECURITY_TOKEN, $valueSecurityToken);

        foreach (\UPS\Shipping\Helper\Config::LIST_CLEAR_CACHE as $type) {
            $this->cacheTypeList->cleanType($type);
        }
        $this->checkoutSession->setHandshakeKey($valueSecurityToken);
        $this->apiHandshake->callAPIHandshake($websiteMerchant, $getMerchantKey, $valueSecurityToken);
    }

    /**
     * Country getFormKey
     *
     * @return array $serviceData
     */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }

    public function check_url_1()
    {
        $url_1 = "https://fa-ecptools-prd.azurewebsites.net/";
        $headers = get_headers($url_1);
        if($headers && strpos( $headers[0], '200') !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function check_url_2()
    {
        $url_2 = "https://onlinetools.ups.com/";
        $headers = get_headers($url_2);
        if($headers && strpos( $headers[0], '200') !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function check_url_3()
    {
        $url_3 = "https://fa-ecpanalytics-prd.azurewebsites.net/";
        $headers = get_headers($url_3);
        if($headers && strpos( $headers[0], '200') !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function check_maintenance()
    {
        $flag = $this->maintenanceMode->isOn();
        if ($flag) {
            return false;   //returns false if maintenance enabled
        } else {
            return true;
        }
    }

    public function check_curr_url_ssl()
    {
        if (strpos($this->storeManager->getStore()->getBaseUrl(), "ar.mage") !== false) {
            return true;
        }
        $ssl = $this->storeManager->getStore()->isCurrentlySecure();
        return $ssl;
    }
}
