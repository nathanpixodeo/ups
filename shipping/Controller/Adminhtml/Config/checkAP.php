<?php
/**
 * checkAP file
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
namespace UPS\Shipping\Controller\Adminhtml\Config;

/**
 * checkAP class
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
class checkAP extends \Magento\Framework\App\Action\Action
{
    protected $accountModel;
    protected $apiRate;
    protected $scopeConfig;
    protected $timezone;
    protected $dateTime;
    protected $resultJsonFactory;
    /**
     * checkAP execute
     *
     * @return null
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \UPS\Shipping\Model\Account $accountModel,
        \UPS\Shipping\API\Rate $apiRate,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ){
        $this->accountModel = $accountModel;
        $this->apiRate = $apiRate;
        $this->scopeConfig = $scopeConfig;
        $this->timezone = $timezone;
        $this->dateTime = $dateTime;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $def_acc = $this->accountModel->getAccountDefault();
        $def_weg_unit = $this->scopeConfig->getValue("general/locale/weight_unit");
        $curr_date = $this->timezone->date($this->dateTime->timestamp())->format('Ymd');
        $dataRequestRate = [
            "ShippingType" => "AP",
            "Typerate" => "createshipment",
            "Request" => [
                "RequestOption" => "Shoptimeintransit"
            ],
            "DeliveryTimeInformation" => [
                // "PackageBillType" => "03",
                "Pickup" => [
                    "Date" => $curr_date
                ]
            ],
            "Shipper" => [
                "Name" => $def_acc['fullname'],
                "ShipperNumber" => $def_acc['ups_account_number'],
                \UPS\Shipping\Helper\ConstantShipment::ADDRESS => [
                    \UPS\Shipping\Helper\ConstantShipment::ADDRESSLINE => [$def_acc['address_1'], $def_acc['address_2'], $def_acc['address_3']],
                    "City" => $def_acc['city'],
                    \UPS\Shipping\Helper\ConstantShipment::STATEPROVINCECODE => (isset($def_acc['state_province_code']) && !empty($def_acc['state_province_code'])) ? $def_acc['state_province_code'] : "XX",
                    \UPS\Shipping\Helper\ConstantShipment::POSTALCODE => $def_acc['post_code'],
                    \UPS\Shipping\Helper\ConstantShipment::COUNTRYCODE => $def_acc['country']
                ]
            ],
            "ShipTo" => [
                "Name" => $def_acc['fullname'],
                \UPS\Shipping\Helper\ConstantShipment::ADDRESS => [
                    \UPS\Shipping\Helper\ConstantShipment::ADDRESSLINE => [$def_acc['address_1'], $def_acc['address_2'], $def_acc['address_3']],
                    "City" => $def_acc['city'],
                    \UPS\Shipping\Helper\ConstantShipment::STATEPROVINCECODE => (isset($def_acc['state_province_code']) && !empty($def_acc['state_province_code'])) ? $def_acc['state_province_code'] : "XX",
                    \UPS\Shipping\Helper\ConstantShipment::POSTALCODE => $def_acc['post_code'],
                    \UPS\Shipping\Helper\ConstantShipment::COUNTRYCODE => $def_acc['country']
                ]
            ],
            "ShipFrom" => [
                "Name" => $def_acc['fullname'],
                "ShipperNumber" => $def_acc['ups_account_number'],
                \UPS\Shipping\Helper\ConstantShipment::ADDRESS => [
                    \UPS\Shipping\Helper\ConstantShipment::ADDRESSLINE => [$def_acc['address_1'], $def_acc['address_2'], $def_acc['address_3']],
                    "City" => $def_acc['city'],
                    \UPS\Shipping\Helper\ConstantShipment::STATEPROVINCECODE => (isset($def_acc['state_province_code']) && !empty($def_acc['state_province_code'])) ? $def_acc['state_province_code'] : "XX",
                    \UPS\Shipping\Helper\ConstantShipment::POSTALCODE => $def_acc['post_code'],
                    \UPS\Shipping\Helper\ConstantShipment::COUNTRYCODE => $def_acc['country']
                ]
            ],
            "AlternateDeliveryAddress" => [
                "Name" => $def_acc['fullname'],
                "AttentionName" => $def_acc['fullname'],
                "Address" => [
                    \UPS\Shipping\Helper\ConstantShipment::ADDRESSLINE => [$def_acc['address_1'], $def_acc['address_2'], $def_acc['address_3']],
                    "City" => $def_acc['city'],
                    \UPS\Shipping\Helper\ConstantShipment::STATEPROVINCECODE => (isset($def_acc['state_province_code']) && !empty($def_acc['state_province_code'])) ? $def_acc['state_province_code'] : "XX",
                    \UPS\Shipping\Helper\ConstantShipment::POSTALCODE => $def_acc['post_code'],
                    \UPS\Shipping\Helper\ConstantShipment::COUNTRYCODE => $def_acc['country']
                ]
            ],
            "PaymentDetails" => [
                "ShipmentCharge" => [
                    "Type" => "01",
                    "BillShipper" => [
                        "AccountNumber" => $def_acc['ups_account_number']
                    ]
                ]
            ],
            "InvoiceLineTotal" => [
                "CurrencyCode" => \UPS\Shipping\Helper\Config::LISTCURRENCYS[$def_acc["country"]][1],
                "MonetaryValue" => "10"
            ],
            "ShipmentRatingOptions" => [
                "NegotiatedRatesIndicator" => ""
            ],
            "Package" => [
                [
                    "Dimensions" => [
                        "UnitOfMeasurement" => [
                            "Code" => ('LBS' == strtoupper($def_weg_unit)) ? "IN" : "CM",
                            \UPS\Shipping\Helper\ConstantShipment::DESCRIPTION => ('LBS' == strtoupper($def_weg_unit)) ? "inches" : "centimeter"
                        ],
                        "Length" => "1",
                        "Width" => "1",
                        "Height" => "1"
                    ],
                    "PackageWeight" => [
                        "UnitOfMeasurement" => [
                            "Code" => $def_weg_unit,
                            \UPS\Shipping\Helper\ConstantShipment::DESCRIPTION =>  ('LBS' == strtoupper($def_weg_unit)) ? "Pounds" : "kilograms"
                        ],
                        "Weight" => "1"
                    ],
                    "Packaging" => [
                        "Code" => "02"
                    ],
                    "PackagingType" => [
                        "Code" => "02"
                    ],
                ]
            ]
        ];
        $rate_res = json_decode($this->apiRate->shopTimeInTransit($dataRequestRate, "02"));
        $res_json = $this->resultJsonFactory->create();
        if (isset($rate_res->RateResponse->Response->ResponseStatus->Code) && (string)$rate_res->RateResponse->Response->ResponseStatus->Code == "1") {
            $res_json->setData(["status" => "success"]);
        } elseif (isset($rate_res->Fault->faultstring)) {
            $res_json->setData(["status" => (string)$rate_res->Fault->faultstring]);
        } else {
            $res_json->setData(["status" => "Unknown error. Can't able to enable AP service."]);
        }
        return $res_json;        
    }
}
