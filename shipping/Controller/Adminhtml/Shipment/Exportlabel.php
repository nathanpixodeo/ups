<?php
/**
 * Exportlabel file
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
 * Exportlabel class
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
class Exportlabel extends \Magento\Framework\App\Action\Action
{
    /**
     * Api
     *
     * @var protected $api
     */
    protected $api;
    protected $dirMagen;
    protected $io;
    protected $fileFactory;

    /**
     * Exportlabel constructor
     *
     * @param string $context  //The Context
     * @param string $api      //The Api
     * @param string $dirMagen //The dirMagen
     * @param string $io       //The io
     *
     * @return null
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \UPS\Shipping\API\Shipment $api,
        \Magento\Framework\Filesystem\DirectoryList $dirMagen,
        \Magento\Framework\Filesystem\Io\File $io,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory
    ) {
        $this->api = $api;
        $this->dirMagen = $dirMagen;
        $this->io = $io;
        $this->fileFactory = $fileFactory;
        parent::__construct($context);
    }

    /**
     * Exportlabel execute
     *
     * @return null
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $listOrder = json_decode($data['listCheckedLabel']);
        $listOrder = array_unique($listOrder);
        $labelFormat = $data['labelFormat'];
        $fileExt = '.' . strtolower($labelFormat);
        $tmp_dir = $this->dirMagen->getPath('tmp');
        $this->io->mkdir($tmp_dir . "/LabelShipment", 0755);

        $toPdf = [];

        foreach ($listOrder as $key => $value) {
            $dataRequest = [
                'TrackingNumber' => $value,
                'LabelFormat' => $labelFormat
            ];
            $labelRecovery = json_decode($this->api->labelRecovery($dataRequest));
            $decoded = "";

            if (isset($labelRecovery->LabelRecoveryResponse->Response->ResponseStatus->Code)
                && ($labelRecovery->LabelRecoveryResponse->Response->ResponseStatus->Code == 1)
                && isset($labelRecovery->LabelRecoveryResponse->LabelResults)
            ) {
                if (is_array($labelRecovery->LabelRecoveryResponse->LabelResults)) {
                    foreach ($labelRecovery->LabelRecoveryResponse->LabelResults as $labelResult) {
                        if (isset($labelResult->LabelImage)) {
                            $decoded .= base64_decode($labelResult->LabelImage->GraphicImage);
                        }
                    }
                } else {
                    $decoded = base64_decode($labelRecovery->LabelRecoveryResponse->LabelResults->LabelImage->GraphicImage);
                }

                $tempFileName = \UPS\Shipping\Helper\Config::NAME_PRINT_LABEL . "_" . $value . $fileExt;
                $tempName = $tmp_dir . "/LabelShipment/" . $tempFileName;
                file_put_contents($tempName, $decoded);
                if (count($listOrder) == 1) {
                    $fileName = \UPS\Shipping\Helper\Config::NAME_PRINT_LABEL . "_" . $value . $fileExt;
                    return $this->fileFactory->create($fileName, ['type'  => 'filename', 'value' => $tempName, 'rm' => true]);
                    // return $this->fileFactory->create($fileName, @file_get_contents($tempName));
                    // return $this->io->rmdirRecursive($tmp_dir . "/LabelShipment");
                } else {
                    $toPdf[] = ["path" => $tempName, "filename" => $tempFileName];
                }
            }
        }
        $linkzip = sys_get_temp_dir() . "\\" . \UPS\Shipping\Helper\Config::NAME_PRINT_LABEL . ".zip";
        $zip = new \ZipArchive();
        $zip->open($linkzip, \ZipArchive::CREATE);
        foreach ($toPdf as $pdf_k => $pdf_link) {
            $zip->addFile($pdf_link['path'], $pdf_link['filename']);
        }
        $zip->close();

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=".\UPS\Shipping\Helper\Config::NAME_PRINT_LABEL.".zip");
        header("Content-Type: application/download");
        header("Content-Transfer-Encoding: binary");
        readfile($linkzip);
        $this->unlinkFile($linkzip);
        $this->io->rmdirRecursive($tmp_dir . "/LabelShipment");
    }

    /**
     * Exportlabel unlinkFile
     *
     * @param string $link //The PDF file link
     *
     * @return null
     */
    public function unlinkFile($link)
    {
        if (file_exists($link)) {
            unlink($link);
        }
    }
    public function getLabel($trk_no, $l_format)
    {
        $labelFormat = $l_format;
        $fileExt = '.' . strtolower($labelFormat);
        $tmp_dir = $this->dirMagen->getPath('tmp');
        $this->io->mkdir($tmp_dir . "/LabelShipment", 0755);

            $dataRequest = [
                'TrackingNumber' => $trk_no,
                'LabelFormat' => $labelFormat
            ];
            $labelRecovery = json_decode($this->api->labelRecovery($dataRequest));
            $decoded = "";

            if (isset($labelRecovery->LabelRecoveryResponse->Response->ResponseStatus->Code)
                && ($labelRecovery->LabelRecoveryResponse->Response->ResponseStatus->Code == 1)
                && isset($labelRecovery->LabelRecoveryResponse->LabelResults)
            ) {
                if (is_array($labelRecovery->LabelRecoveryResponse->LabelResults)) {
                    foreach ($labelRecovery->LabelRecoveryResponse->LabelResults as $labelResult) {
                        if (isset($labelResult->LabelImage)) {
                            $decoded .= base64_decode($labelResult->LabelImage->GraphicImage);
                        }
                    }
                } else {
                    $decoded = base64_decode($labelRecovery->LabelRecoveryResponse->LabelResults->LabelImage->GraphicImage);
                }

                $tempName = $tmp_dir . "/LabelShipment/" . \UPS\Shipping\Helper\Config::NAME_PRINT_LABEL . "_" . $trk_no . $fileExt;
                file_put_contents($tempName, $decoded);

                $fileName = \UPS\Shipping\Helper\Config::NAME_PRINT_LABEL . "_" . $trk_no . $fileExt;
                return $this->fileFactory->create($fileName, ['type'  => 'filename', 'value' => $tempName, 'rm' => true]);
                // return $this->fileFactory->create($fileName, @file_get_contents($tempName));
            }

    }
}
