<?php

namespace UPS\Shipping\Observer;

class BeforeSaveOrder implements \Magento\Framework\Event\ObserverInterface
{
	protected $openOrder;
	protected $checkoutSession;
	protected $scopeConfig;

	public function __construct(
        \UPS\Shipping\Model\Order $openOrderModel,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->openOrder = $openOrderModel;
        $this->checkoutSession = $checkoutSession;
        $this->scopeConfig = $scopeConfig;
    }

	public function execute($observer)
	{
	    $apAsShipToString = $this->scopeConfig->getValue(\UPS\Shipping\Helper\Config::SERVICE_UPS_SHIPPING_DELIVERY_SET_AP_AS_SHIP);
        $apAddr = !empty($this->checkoutSession->getSelectedAPAddress()) ? json_decode($this->checkoutSession->getSelectedAPAddress(), true) : [];
        if (!empty($apAsShipToString) && ($apAsShipToString == 1) && !empty($apAddr)) {
        	$ap_state = isset($apAddr['PoliticalDivision1']) ? $apAddr['PoliticalDivision1'] : '';
			$ap_zip = isset($apAddr['PostcodePrimaryLow']) ? $apAddr['PostcodePrimaryLow'] : '';
			$ap_addr1 = isset($apAddr['AddressLine']) ? base64_decode($apAddr['AddressLine']) : '';
			$ap_city = isset($apAddr['PoliticalDivision2']) ? $apAddr['PoliticalDivision2'] : '';
			$ap_name = isset($apAddr['ConsigneeName']) ? $apAddr['ConsigneeName'] : '';
			$order = $observer->getOrder();
			$shipping_address = $order->getShippingAddress();
			$cus_del_addr = array("name" => $shipping_address->getFirstname()." ".$shipping_address->getLastname(), "street" => $shipping_address->getStreet(), "city" => $shipping_address->getCity(), "state" => $shipping_address->getRegionCode(), "zip" => $shipping_address->getPostcode(), "country" => $shipping_address->getCountryId());
			$this->checkoutSession->setCusDelAddress($cus_del_addr);
			$shipping_address
	          ->setStreet($ap_addr1)
	          ->setCity($ap_city)
	          ->setRegion($ap_state)
	          ->setPostcode($ap_zip)
	          ->setFirstname($ap_name)
	          ->setLastname("")
	          ->setRegionId("");
	        $shipping_address->save();
	    }
	}
}