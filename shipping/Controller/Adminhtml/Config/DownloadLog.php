<?php
/**
 * SaveCountry file
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

// Use \Magento\Framework\App\ResourceConnection;
// use Magento\Framework\App\Config\ScopeConfigInterface;


/**
 * SaveCountry class
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
class DownloadLog extends \Magento\Framework\App\Action\Action
{
    // protected $_messageManager;

    // public function __construct(
    //     \Magento\Framework\Message\ManagerInterface $messageManager
    // ) {
    //     $this->_messageManager = $messageManager;
    // }

    public function execute()
    {
        // get data form
        $dataForm = $this->getRequest()->getParams();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $FormKey = $objectManager->get('Magento\Framework\Data\Form\FormKey');
        
        if (isset($dataForm['dwnld_ups_api_log']) && isset($dataForm['form_key']) && ($dataForm['form_key'] == $FormKey->getFormKey())) {
            $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
            $connection = $resource->getConnection();

            try {
                $getLogSql = "Select `id`, `method`, `full_uri`, `request`, `response`, `time_request`, `time_response` FROM `ups_shipping_logs_api` order by `id` desc limit 0, 100";
                $getLogResult = $connection->fetchAll($getLogSql);
            } catch (\Magento\Framework\DB\Adapter\TableNotFoundException $e) {
                // $this->_redirect('upsshipping/config/about');
            }

            $log_file_url = 'ups_api_log.csv';
            
            if (isset($getLogResult) && !empty($getLogResult)) {
                $fp = fopen($log_file_url, 'w');
                fputcsv($fp, ['id', 'method', 'full_uri', 'request', 'response', 'time_request', 'time_response']);
                foreach ($getLogResult as $log) {
                    if (isset($log['id']) && isset($log['method']) && isset($log['full_uri']) && isset($log['request']) && isset($log['response']) && isset($log['time_request']) && isset($log['time_response'])) {
                        fputcsv($fp, $log);
                    }
                }
                
                fclose($fp);

                $log_file_name = basename($log_file_url);
                
                $log_file_info = pathinfo($log_file_name);
                
                if ($log_file_info["extension"] == "csv") {
                    header("Content-Description: File Transfer");
                    header("Content-Type: application/octet-stream");
                    header(
                        "Content-Disposition: attachment; filename=\""
                        . $log_file_name . "\""
                    );

                    readfile($log_file_url);
                }
                unlink($log_file_url);
            } else {
                $this->_redirect('upsshipping/config/about');
            }
            
        }
    }
}
