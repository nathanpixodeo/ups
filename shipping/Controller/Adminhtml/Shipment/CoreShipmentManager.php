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
class CoreShipmentManager extends \Magento\Framework\App\Action\Action
{
    protected $_orderRepository;
    protected $_convertOrder;
    protected $_shipmentNotifier;
    protected $shipmentRepository;
    protected $trackFactory;
    protected $trackCollectionFactory;
    /**
     * @param Context                                     $context
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     * @param \Magento\Sales\Model\Convert\Order          $convertOrder
     * @param \Magento\Shipping\Model\ShipmentNotifier    $shipmentNotifier
     * @param ShipmentRepositoryInterface                 $shipmentRepository
     * @param ShipmentTrackInterfaceFactory               $trackFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Sales\Model\Convert\Order $convertOrder,
        \Magento\Shipping\Model\ShipmentNotifier $shipmentNotifier,
        \Magento\Sales\Api\ShipmentRepositoryInterface $shipmentRepository,
        \Magento\Sales\Api\Data\ShipmentTrackInterfaceFactory $trackFactory,
        \Magento\Sales\Model\ResourceModel\Order\Shipment\Track\CollectionFactory $trackCollectionFactory
    ) {
        $this->_orderRepository = $orderRepository;
        $this->_convertOrder = $convertOrder;
        $this->_shipmentNotifier = $shipmentNotifier;
        $this->shipmentRepository = $shipmentRepository;
        $this->trackFactory = $trackFactory;
        $this->trackCollectionFactory = $trackCollectionFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        
    }
    public function createShipment($orderId = "", $trk_no = "")
    {
        if (empty($orderId) || empty($trk_no)) {
            return;
        }
        $order = $this->_orderRepository->get($orderId);
        // to check order can ship or not
        if (!$order->canShip()) {
            return;
        }
        $orderShipment = $this->_convertOrder->toShipment($order);
        foreach ($order->getAllItems() AS $orderItem) {
            // Check virtual item and item Quantity
            if (!$orderItem->getQtyToShip() || $orderItem->getIsVirtual()) {
               continue;
            }
            $qty = $orderItem->getQtyToShip();
            $shipmentItem = $this->_convertOrder->itemToShipmentItem($orderItem)->setQty($qty);
            $orderShipment->addItem($shipmentItem);
        }
        $orderShipment->register();
        try {
            // Save tracking
            $track = $this->trackFactory->create();
            $track->setCarrierCode("ups");
            // $track->setDescription("testing UPS");
            $track->setTitle("UPS Official");
            $track->setTrackNumber($trk_no);
            $orderShipment->addTrack($track);
            // Save created Order Shipment
            $orderShipment->save();
            $orderShipment->getOrder()->save();
            // Send Shipment Email
            $this->_shipmentNotifier->notify($orderShipment);
            $orderShipment->save();
        } catch (\Exception $e) {
            // Exception handling
        }
    }
    public function deleteShipment($shipment_no = "")
    {
        if (empty($shipment_no)) {
            return;
        }
        try{
            $trk_col_fac = $this->trackCollectionFactory->create();
            $trk_col_fac->addFieldToFilter('track_number', $shipment_no);
            /** @var Shipment\Track $tracking */
            $tracking = $trk_col_fac->getFirstItem();
            if (empty($tracking->getData())) {
                return;
            }
            $s_id = $tracking->getShipment()->getId();
            $orderId = $tracking->getOrderId();
        } catch (Exception $exception)  {
            // Exception handling
            return;
        }
        
        try {
            // Delete shipment
            $shipment = $this->shipmentRepository->get($s_id);
            $deleteShipment = $this->shipmentRepository->delete($shipment);
            // Get order and set all products as non-shipped
            $order = $this->_orderRepository->get($orderId);
            foreach ($order->getAllItems() AS $orderItem) {
                $orderItem->setQtyShipped(0);
                $orderItem->save();
            }
        } catch (Exception $exception)  {
            // Exception handling
        }
    }
}