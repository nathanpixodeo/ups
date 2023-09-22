<?php
namespace UPS\Shipping\Block\Adminhtml\Config;

// use Magento\Framework\View\Element\Template;
class View extends \Magento\Framework\View\Element\Template
{
    protected $modelOrderServices;
    protected $modelOrderResource;
    protected $formKey;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \UPS\Shipping\Model\ResourceModel\Service $modelOrderServices,
        \UPS\Shipping\Model\ResourceModel\Order $modelOrderResource,
        \Magento\Framework\Data\Form\FormKey $formKey
    ) {
        $this->modelOrderServices = $modelOrderServices;
        $this->modelOrderResource = $modelOrderResource;
        $this->formKey = $formKey;
        parent::__construct($context);
        // $this->_init('UPS\Shipping\Model\ResourceModel\Order');
    }
    public function getPostData()
    {
      // you can use below code in any function
        $postData =  $this->getRequest()->getParams();
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
    public function getDetailOrder()
    {
        $order_id = $this->getRequest()->getParam('order_id');
        $order_data = [];

        if (!empty($order_id)) {
            $select = $this->modelOrderResource->getConnection()->select()
                ->from($this->modelOrderResource->getMainTable())
                ->where('order_id_magento = '.$order_id);
            
            $query = $this->modelOrderResource->getConnection()->query($select);
            while ($row = $query->fetch()) {
                $order_data = $row;
            }
        }
        if (isset($order_data['id'])) {
            $trk_no = $this->getTrackNoByID($order_data['id']);
            $order_data['trk_no'] = !empty($trk_no) ? $trk_no : '';
        }
        return $order_data;
    }
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
    public function getTrackNoByID($id)
    {
        $num = "";
        if (!empty($id)) {
            $select = $this->modelOrderResource->getConnection()->select()
                ->from(\UPS\Shipping\Helper\ConstantModel::UPS_SHIPPING_TRACKING, 'shipment_number')
                ->where('order_id = '.$id);
            
            $query = $this->modelOrderResource->getConnection()->query($select);
            while ($row = $query->fetch()) {
                $num = isset($row['shipment_number']) ? $row['shipment_number'] : '';
            }
        }
        return $num;
    }
}
