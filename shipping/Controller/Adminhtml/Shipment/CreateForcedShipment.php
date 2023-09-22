<?php
/**
 * CreateForcedShipment file
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
namespace UPS\Shipping\Controller\Adminhtml\Shipment;

/**
 * Createshipment class
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
class CreateForcedShipment extends \Magento\Framework\App\Action\Action
{
    protected $Createshipment;
    protected $OrderDetail;
    protected $modelOrderServices;
    protected $Exportlabel;
    protected $apiRate;
    protected $scopeConfig;
    protected $timezone;
    protected $dateTime;
    protected $modelAccount;
    protected $modelOrderResource;
    protected $openOrder;
    protected $packageDimension;
    protected $orderRepo;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \UPS\Shipping\API\Rate $apiRate,
        \UPS\Shipping\Controller\Adminhtml\Shipment\Createshipment $Createshipment,
        \UPS\Shipping\Model\ResourceModel\Service $modelOrderServices,
        \UPS\Shipping\Model\ResourceModel\Account $modelAccount,
        \UPS\Shipping\Model\ResourceModel\Order $modelOrderResource,
        \UPS\Shipping\Controller\Adminhtml\Shipment\OrderDetail $OrderDetail,
        \UPS\Shipping\Controller\Adminhtml\Shipment\Exportlabel $Exportlabel,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        \UPS\Shipping\Model\Order $openOrderModel,
        \UPS\Shipping\Model\PackageDimension $packageDimension,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepo
    ) {
        $this->apiRate = $apiRate;
        $this->Createshipment = $Createshipment;
        $this->OrderDetail = $OrderDetail;
        $this->modelOrderServices = $modelOrderServices;
        $this->modelAccount = $modelAccount;
        $this->modelOrderResource = $modelOrderResource;
        $this->Exportlabel = $Exportlabel;
        $this->scopeConfig = $scopeConfig;
        $this->timezone = $timezone;
        $this->dateTime = $dateTime;
        $this->openOrder = $openOrderModel;
        $this->packageDimension = $packageDimension;
        $this->orderRepo = $orderRepo;
        parent::__construct($context);
    }
    public function execute()
    {
        $post_data = $this->getRequest()->getPostValue();
        $result = $this->resultRedirectFactory->create();
        $err_msg = "";
        if (isset($post_data['ups_offi_create_shipment']) && $post_data['ups_offi_create_shipment'] == "yes") {
            $o_o_id = isset($post_data['o_o_id']) ? $post_data['o_o_id'] : '';
            if (!empty($o_o_id)) {
                $order_data = $this->OrderDetail->runDetailOrderForced($o_o_id);
                if (!empty($order_data)) {
                    if (isset($post_data['ups_offi_shipment_service']) || isset($post_data['ups_offi_shipment_service_radio'])) {
                        if (isset($post_data['ups_offi_shipment_service']) && !empty($post_data['ups_offi_shipment_service'])) {
                            $service_data = $this->modelOrderServices->getShippingServiceById($post_data['ups_offi_shipment_service']);
                        }
                        if (isset($post_data['ups_offi_shipment_service_radio']) && !empty($post_data['ups_offi_shipment_service_radio'])) {
                            $service_data = $this->modelOrderServices->getShippingServiceById($post_data['ups_offi_shipment_service_radio']);
                        }
                        $order_data['country_code'] = isset($service_data[0]['country_code']) ? $service_data[0]['country_code'] : '';
                        $order_data['service_type'] = "ADD";
                        $order_data['service_key'] = isset($service_data[0]['service_key']) ? $service_data[0]['service_key'] : '';
                        $order_data['service_name'] = isset($service_data[0]['service_name']) ? $service_data[0]['service_name'] : '';
                        $order_data['rate_code'] = isset($service_data[0]['rate_code']) ? $service_data[0]['rate_code'] : '';
                        $order_data['idservice'] = isset($service_data[0]['id']) ? $service_data[0]['id'] : '';
                        $order_data['service_symbol'] = isset($service_data[0]['service_symbol']) ? $service_data[0]['service_symbol'] : '';
                    }
                    
                    $create_shipment = $this->Createshipment->setCreateAPIForced($order_data);
                    
                    if (isset($create_shipment['status']) && $create_shipment['status'] == "success") {
                        $this->messageManager->addSuccess(__("Shipment created successfully."));
                    } elseif (isset($create_shipment['status']) && $create_shipment['status'] != "success") {
                        $this->messageManager->addError(__($create_shipment['status']));
                    } else {
                        $this->messageManager->addError(__("Unknown Error occured while creating shipment."));
                    }
                } else {
                    $this->messageManager->addError(__("Unknown Order."));
                }
            } else {
                $this->messageManager->addError(__("Can't able to find order data."));
            }
            return $result->setRefererOrBaseUrl();
        }
        if (isset($post_data['ups_offi_dwnld_label']) && $post_data['ups_offi_dwnld_label'] == "yes") {
            $trk_no = isset($post_data['trk_no']) ? $post_data['trk_no'] : '';
            $l_format = isset($post_data['ups_offi_shipment_label_format']) ? $post_data['ups_offi_shipment_label_format'] : '';
            if (!empty($trk_no) && !empty($l_format)) {
                $this->Exportlabel->getLabel($trk_no, $l_format);
            }
            return $result->setRefererOrBaseUrl();
        }
        if (isset($post_data['ups_offi_create_entry']) && $post_data['ups_offi_create_entry'] == "yes") {
            $order_id = (isset($post_data['o_id']) && !empty($post_data['o_id'])) ? $post_data['o_id'] : "";
            if (!empty($order_id)) {
                $order = $this->orderRepo->get($order_id);
                // $order_items = $order->getAllVisibleItems();
                // $order_items = $order->getAllItems();
                $order_items = $order->getItems();
                $packages = $this->packageDimension->getShippingPackageOrder($order_items);
                $openOrder = [
                    'order_id_magento' => $order_id,
                    'shipping_service' => "",
                    'accessorial_service' => "[]",
                    'package' => !empty($packages) ? json_encode($packages) : "",
                    'shipment_id' => 0,
                    'quote_id' => "",
                    'status' => 1,
                    'ap_id' => "",
                    'ap_name' => "",
                    'ap_address1' => "",
                    'ap_address2' => "",
                    'ap_state' => "",
                    'ap_postcode' => "",
                    'ap_city' => "",
                    'ap_country' => '',
                    'cod' => '',
                    'created_at' => date("Y-m-d")
                ];
                $this->openOrder->insertOpenOrderAfterPlace($openOrder);
            } else {
                $this->messageManager->addError(__("Can't able to find order ID."));
            }
            return $result->setRefererOrBaseUrl();
        }
        if ($this->getRequest()->isAjax()) {
            if (isset($post_data['orderIdMagento']) && !empty($post_data['orderIdMagento'])) {
                $order_mag['order_id_magento'] = $post_data['orderIdMagento'];
                $order_data = $this->OrderDetail->getOrderData($order_mag);

                $to_name = "";
                if ($order_data->getCustomerName() != 'Guest') {
                    $to_name = $order_data->getShippingAddress()->getFirstname() . ' '. $order_data->getShippingAddress()->getLastname();
                } else {
                    $to_name = $order_data->getCustomerFirstname() . ' ' . $order_data->getCustomerLastname();
                }

                //hadling date delivery
                $cutOfTime = \UPS\Shipping\Helper\Config::SERVICE_UPS_SHIPPING_CUT_OFF_TIME;
                $timeService = (int) $this->scopeConfig->getValue($cutOfTime) . '00';
                $timeNow = (int) implode('', explode(":", $this->timezone->date($this->dateTime->timestamp())->format('H:i')));
                if ($timeNow < $timeService || $timeNow == $timeService) {
                    $dateAPI = $this->timezone->date($this->dateTime->timestamp())->format('Ymd');
                } else {
                    $date = sprintf('%02d', (int) $this->timezone->date($this->dateTime->timestamp())->format('d') + 1);
                    $dateAPI = $this->timezone->date($this->dateTime->timestamp())->format('Ym') . $date;
                }

                $def_acc = $this->modelAccount->getAccountDefault();
                $open_order_data = $packs = [];

                $select = $this->modelOrderResource->getConnection()->select()
                    ->from($this->modelOrderResource->getMainTable())
                    ->where('order_id_magento = '.$post_data['orderIdMagento']);
                
                $query = $this->modelOrderResource->getConnection()->query($select);
                while ($row = $query->fetch()) {
                    $open_order_data = $row;
                }

                $dataRequestRate = [
                    "ShippingType" => "ADD",
                    "Typerate" => "createshipment",
                    "Request" => [
                        "RequestOption" => "Shoptimeintransit"
                    ],
                    "DeliveryTimeInformation" => [
                        // "PackageBillType" => "03",
                        "Pickup" => [
                            "Date" => $dateAPI
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
                        "Name" => $to_name,
                        \UPS\Shipping\Helper\ConstantShipment::ADDRESS => [
                            \UPS\Shipping\Helper\ConstantShipment::ADDRESSLINE => [$order_data->getShippingAddress()->getStreetLine(1), $order_data->getShippingAddress()->getStreetLine(2), $order_data->getShippingAddress()->getStreetLine(3)],
                            "City" => $order_data->getShippingAddress()->getCity(),
                            \UPS\Shipping\Helper\ConstantShipment::STATEPROVINCECODE => $order_data->getShippingAddress()->getRegionCode(),
                            \UPS\Shipping\Helper\ConstantShipment::POSTALCODE => !empty($order_data->getShippingAddress()->getPostcode()) ? implode("", explode(" ", $order_data->getShippingAddress()->getPostcode())) : "",
                            \UPS\Shipping\Helper\ConstantShipment::COUNTRYCODE => $order_data->getShippingAddress()->getCountryId()
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
                    "PaymentDetails" => [
                        "ShipmentCharge" => [
                            "Type" => "01",
                            "BillShipper" => [
                                "AccountNumber" => $def_acc['ups_account_number']
                            ]
                        ]
                    ],
                    "InvoiceLineTotal" => [
                        "CurrencyCode" => $order_data->getOrderCurrencyCode(),
                        "MonetaryValue" => $order_data->getSubtotal()
                    ],
                    "ShipmentRatingOptions" => [
                        "NegotiatedRatesIndicator" => ""
                    ]
                ];

                if (!empty($open_order_data) && isset($open_order_data['package'])) {
                    $packs_arr = json_decode($open_order_data['package'], true);
                    foreach ($packs_arr as $key => $value) {
                        $dataRequestRate["Package"][$key] = [
                            "PackageWeight" => [
                                "UnitOfMeasurement" => [
                                    "Code" => $value['unit_weight'],
                                    \UPS\Shipping\Helper\ConstantShipment::DESCRIPTION =>  ('LBS' == strtoupper($value['unit_weight'])) ? "Pounds" : "kilograms"
                                ],
                                "Weight" => $value['weight']
                            ],
                            "Packaging" => [
                                "Code" => "02"
                            ],
                            "PackagingType" => [
                                "Code" => "02"
                            ],
                        ];
                        if (isset($value['length']) && isset($value['width']) && isset($value['height'])) {
                            $dataRequestRate["Package"][$key]["Dimensions"] = [
                                "UnitOfMeasurement" => [
                                    "Code" => $value['unit_dimension'],
                                    \UPS\Shipping\Helper\ConstantShipment::DESCRIPTION => ('IN' == strtoupper($value['unit_dimension'])) ? "inches" : "centimeter"
                                ],
                                "Length" => $value['length'],
                                "Width" => $value['width'],
                                "Height" => $value['height']
                            ];
                        }
                    }
                }
                $rate_res = json_decode($this->apiRate->shopTimeInTransit($dataRequestRate));
                if (!empty($rate_res) && isset($rate_res->RateResponse->RatedShipment)) {
                    $service_codes = [];
                    $final_rates = [];
                    $add_services = $this->getAllListService();
                    if (!empty($add_services)) {
                        foreach ($add_services as $ser) {
                            if (isset($ser['rate_code']) && $ser['service_name']) {
                                $service_codes[$ser['rate_code']]['ser_name'] = $ser['service_name'];
                                $service_codes[$ser['rate_code']]['ser_id'] = $ser['id'];
                            }
                        }
                        foreach ($rate_res->RateResponse->RatedShipment as $rates) {
                            if (isset($rates->Service->Code) && isset($service_codes[(string)$rates->Service->Code])) {
                                $curr_rates = [];
                                $curr_rates['ser_id'] = $service_codes[(string)$rates->Service->Code]['ser_id'];
                                $curr_rates['rate_des'] = $service_codes[(string)$rates->Service->Code]['ser_name'];
                                $curr_rates['rate_code'] = (string)$rates->Service->Code;
                                if (isset($rates->NegotiatedRateCharges->TotalCharge->MonetaryValue)) {
                                    $curr_rates['currency'] = (string)$rates->NegotiatedRateCharges->TotalCharge->CurrencyCode;
                                    $curr_rates['rate'] = (string)$rates->NegotiatedRateCharges->TotalCharge->MonetaryValue;
                                } else {
                                    $curr_rates['currency'] = (string)$rates->TotalCharges->CurrencyCode;
                                    $curr_rates['rate'] = (string)$rates->TotalCharges->MonetaryValue;
                                }
                                $final_rates[] = $curr_rates;
                            }
                        }
                        if (!empty($final_rates)) {
                            print_r( json_encode(array("status" => "success", "rates_list" => $final_rates)) );
                        } else {
                            print_r( json_encode(array("status" => "No rates found for enabled services.")) );
                        }
                    } else {
                        print_r( json_encode(array("status" => "Try again by enabling non-AP services.")) );
                    }
                } elseif (isset($rate_res->Fault->faultstring)) {
                    print_r( json_encode(array("status" => (string)$rate_res->Fault->faultstring)) );
                } else {
                    print_r( json_encode(array("status" => "No response found.")) );
                }
            }
        }
    }
    public function getAllListService()
    {
        $active_services = [];
        $all_services = $this->modelOrderServices->getAllListService();
        if (!empty($all_services)) {
            foreach ($all_services as $service) {
                if (isset($service['service_type']) && ($service['service_type'] == "ADD")) {
                    if (isset($service['service_selected']) && ($service['service_selected'] == 1)) {
                        $active_services[] = $service;
                    }
                }
            }
        }
        return $active_services;
    }
}
