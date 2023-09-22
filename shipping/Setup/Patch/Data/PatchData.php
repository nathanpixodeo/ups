<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace UPS\Shipping\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
/**
* Patch is mechanism, that allows to do atomic upgrade data changes
*/
class PatchData implements DataPatchInterface
{
    const NULLABLE = 'nullable';
    const COMMENT = 'comment';
    const VAL_DEFAULT = 'default';
    const SCOPE = 'scope';
    const SCOPE_ID = 'scope_id';
    const VALUE = 'value';
    const STATUS = 'status';
    const LABEL = 'label';
    const ACCESSORIAL_NAME = 'accessorial_name';
    const ACCESSORIAL_KEY = 'accessorial_key';
    const SHOW_SHIPPING = 'show_shipping';
    const SHOW_CONFIG = 'show_config';
    const ACCESSORIAL_CODE = 'accessorial_code';
    const SERVICE_KEY_DELIVERY = 'service_key_delivery';
    const SERVICE_KEY = 'service_key';
    const SERVICE_TYPE = 'service_type';
    const SERVICE_KEY_VAL = 'service_key_val';
    const COUNTRY_CODE = 'country_code';
    const RATE_CODE = 'rate_code';
    const SERVICE_NAME = 'service_name';
    const TIN_T_CODE = 'tin_t_code';
    const SERVICE_SYMBOL = 'service_symbol';
    const SERVICE_SELECTED = 'service_selected';
    const UPS_STANDARD = 'UPS Standard';
    const UPS_STANDARD_SAT_DELI = 'UPS Standard - Saturday Delivery';
    const SYMBOL_REG = '&reg;';
    const UPS_EXPEDITED = 'UPS Expedited';
    const UPS_EXPRESS_SAVER = 'UPS Express Saver';
    const UPS_EXPRESS = 'UPS Express';
    const UPS_EXPRESS_SAT_DELI = 'UPS Express - Saturday Delivery';
    const UPS_EXPRESS12 = 'UPS Express 12:00';
    const UPS_EXPRESS_PLUS = 'UPS Express Plus';
    const TIME_HI_AND_VERSION = 'time_hi_and_version';
    const CLOCK_SEQ = 'clock_seq';
    const UPS_DAY_AIR = 'UPS 2nd Day Air';
    const UPS_DAY_AIR_AM = 'UPS 2nd Day Air A.M.';
    const UPS_3_DAY_SELECT = 'UPS 3 Day Select';
    const UPS_GROUND = 'UPS Ground';
    const UPS_AIR_EARLY = 'UPS Next Day Air Early';
    const UPS_AIR_SAVER = 'UPS Next Day Air Saver';
    const UPS_AIR = 'UPS Next Day Air';
    const UPS_WORLDWIDE_EXPEDITED = 'UPS Worldwide Expedited';
    const UPS_WORLDWIDE_EXPRESS_PLUS = 'UPS Worldwide Express Plus';
    const UPS_WORLDWIDE_EXPRESS = 'UPS Worldwide Express';
    const UPS_WORLDWIDE_SAVER = 'UPS Worldwide Saver';
    /**
     * @var ModuleDataSetupInterface $moduleDataSetup
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        //The code that you want apply in the patch
        //Please note, that one patch is responsible only for one setup version
        //So one UpgradeData can consist of few data patches
        
        $setup = $this->moduleDataSetup;
        $merchantKey = $this->generateMerchantKey();
        $dataConfigs = [
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_TERM_CONDITION, self::VALUE => '0'],
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_SHOW_TERM_CONDITION, self::VALUE => '1'],
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_ACCOUNT, self::VALUE => '0'],
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_SHIPPING_SERVICE, self::VALUE => '0'],
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_CASH_ON_DELIVERY, self::VALUE => '0'],
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_ACCESSORIAL, self::VALUE => '0'],
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_PACKAGE_DIMENSIONS, self::VALUE => '0'],
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_DELIVERY_RATES, self::VALUE => '0'],
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_ACCEPT_BILLING_PREFERENCE, self::VALUE => '0'],
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_COUNTRY_CODE, self::VALUE => 'PL'],
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::SERVICE_UPS_SHIPPING_DELIVERY_SET_DEFAULT, self::VALUE => '1'],
            // config keys
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::UPS_MERCHANTINFO_EXIST, self::VALUE => '0'],

            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::UPS_DELIVERYRATES_EXIST, self::VALUE => '0'],
            // Merchant key
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::UPS_MERCHANTKEY, self::VALUE => $merchantKey],
            // Ups COD Option
            [ self::SCOPE => self::VAL_DEFAULT, self::SCOPE_ID => 0,
            'path' => \UPS\Shipping\Helper\Config::CASH_ON_DELIVERY_UPS_SHIPPING_OPTION_ACTIVE, self::VALUE => '0']
        ];

        $statusShipment = [
            [ self::STATUS => 'shipped', self::LABEL => 'Shipped'],
            [ self::STATUS => 'delivered', self::LABEL => 'Delivered'],
            [ self::STATUS => 'order_canceled', self::LABEL => 'Order Canceled'],
            [ self::STATUS => 'refunded', self::LABEL => 'Refunded'],
            [ self::STATUS => 'processing_in_progress', self::LABEL => 'Processing In Progress']
        ];
        foreach ($statusShipment as $data) {
            $setup->getConnection()->insertOnDuplicate($setup->getTable('sales_order_status'), $data);
        }

        //insert data License
        $tableName = $setup->getTable('ups_shipping_license');
        $sqlLic = "SELECT id FROM $tableName";
        $license = [];
        $query = $setup->getConnection()->query($sqlLic);
        while ($row = $query->fetch()) {
            $license[] = $row;
        }
        if (empty($license)) {
            $insertData = [
                'id' => '1',
                'AccessLicenseText' => '',
                'Username' => 'TuChu0103',
                'Password' => 'T!@#052018',
                'AccessLicenseNumber' => '0D46678E86A9D038'
            ];
            $setup->getConnection()->insertOnDuplicate($setup->getTable('ups_shipping_license'), $insertData);
        }

        //accessorial
        $tableName = $setup->getTable('ups_shipping_accessorial');
        $sqlAccess = "SELECT id FROM $tableName WHERE `id` = 'UPS_ACSRL_ADDITIONAL_HADING'";
        $accessHandle = [];
        $query = $setup->getConnection()->query($sqlAccess);
        while ($row = $query->fetch()) {
            $accessHandle[] = $row;
        }
        if (empty($accessHandle)) {
            $dataAccessorial = [
                ['id' => 1, self::ACCESSORIAL_KEY => 'UPS_ACSRL_ADDITIONAL_HADING', self::ACCESSORIAL_NAME
                => 'Additional handling',
                 self::ACCESSORIAL_CODE => '100', self::SHOW_CONFIG => 1, self::SHOW_SHIPPING => 0],
                ['id' => 2, self::ACCESSORIAL_KEY => 'UPS_ACSRL_QV_SHIP_NOTIF',
                self::ACCESSORIAL_NAME => 'Quantum View Ship Notification', self::ACCESSORIAL_CODE => '6',
                self::SHOW_CONFIG => 1, self::SHOW_SHIPPING => 0],
                ['id' => 3, self::ACCESSORIAL_KEY => 'UPS_ACSRL_QV_DLV_NOTIF',
                self::ACCESSORIAL_NAME => 'Quantum View Delivery Notification', self::ACCESSORIAL_CODE => '372',
                self::SHOW_CONFIG => 1, self::SHOW_SHIPPING => 0],
                ['id' => 4, self::ACCESSORIAL_KEY => 'UPS_ACSRL_RESIDENTIAL_ADDRESS',
                self::ACCESSORIAL_NAME => 'Residential Address', self::ACCESSORIAL_CODE => '270',
                self::SHOW_CONFIG => 0, self::SHOW_SHIPPING => 0],
                ['id' => 5, self::ACCESSORIAL_KEY => 'UPS_ACSRL_STATURDAY_DELIVERY',
                self::ACCESSORIAL_NAME => 'Saturday Delivery', self::ACCESSORIAL_CODE => '300', self::SHOW_CONFIG => 0,
                self::SHOW_SHIPPING => 0],
                ['id' => 6, self::ACCESSORIAL_KEY => 'UPS_ACSRL_CARBON_NEUTRAL', self::ACCESSORIAL_NAME => 'Carbon Neutral',
                self::ACCESSORIAL_CODE => '441', self::SHOW_CONFIG => 1, self::SHOW_SHIPPING => 0],
                ['id' => 7, self::ACCESSORIAL_KEY => 'UPS_ACSRL_DIRECT_DELIVERY_ONLY',
                self::ACCESSORIAL_NAME => 'Direct Delivery Only', self::ACCESSORIAL_CODE => '541', self::SHOW_CONFIG => 0,
                self::SHOW_SHIPPING => 0],
                ['id' => 8, self::ACCESSORIAL_KEY => 'UPS_ACSRL_DECLARED_VALUE', self::ACCESSORIAL_NAME => 'Declared value',
                self::ACCESSORIAL_CODE => '5', self::SHOW_CONFIG => 0, self::SHOW_SHIPPING => 0],
                ['id' => 9, self::ACCESSORIAL_KEY => 'UPS_ACSRL_SIGNATURE_REQUIRED', self::ACCESSORIAL_NAME
                => 'Signature Required',
                 self::ACCESSORIAL_CODE => '2', self::SHOW_CONFIG => 1, self::SHOW_SHIPPING => 0],
                ['id' => 10, self::ACCESSORIAL_KEY => 'UPS_ACSRL_ADULT_SIG_REQUIRED',
                self::ACCESSORIAL_NAME => 'Adult Signature Required', self::ACCESSORIAL_CODE => '3', self::SHOW_CONFIG => 1,
                self::SHOW_SHIPPING => 0],
                ['id' => 11, self::ACCESSORIAL_KEY => 'UPS_ACSRL_ACCESS_POINT_COD', self::ACCESSORIAL_NAME
                => 'To Access Point COD',
                 self::ACCESSORIAL_CODE => '4', self::SHOW_CONFIG => 0, self::SHOW_SHIPPING => 0],
                ['id' => 12, self::ACCESSORIAL_KEY => 'UPS_ACSRL_TO_HOME_COD', self::ACCESSORIAL_NAME => 'To Home COD',
                self::ACCESSORIAL_CODE => '500', self::SHOW_CONFIG => 0, self::SHOW_SHIPPING => 0]
            ];
            foreach ($dataAccessorial as $data) {
                $setup->getConnection()->insertOnDuplicate($setup->getTable('ups_shipping_accessorial'), $data);
            }
        }

        //services
        $dataServices = [
            ['id' => 1, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'AP',
            self::SERVICE_KEY => 'UPS_SP_SERV_PL_AP_AP_ECONOMY',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_AP_AP_ECONOMY',
            self::SERVICE_KEY_VAL => 'UPS_DELI_PL_AP_AP_ECONOMY_VAL',
            self::SERVICE_NAME => 'UPS Access Point Economy', self::RATE_CODE => '70', self::TIN_T_CODE => '39',
            self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => '&trade;'],
            ['id' => 2, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'AP',
            self::SERVICE_KEY => 'UPS_SP_SERV_PL_AP_STANDARD',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_AP_STANDARD',
            self::SERVICE_KEY_VAL => 'UPS_DELI_PL_AP_STANDARD_VAL',
            self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => '25',
            self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 3, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'AP',
            self::SERVICE_KEY => 'UPS_SP_SERV_PL_AP_EXPEDITED',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_AP_EXPEDITED',
            self::SERVICE_KEY_VAL => 'UPS_DELI_PL_AP_EXPEDITED_VAL',
            self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => '05',
            self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 4, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'AP',
            self::SERVICE_KEY => 'UPS_SP_SERV_PL_AP_EXPRESS_SAVER',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_AP_EXPRESS_SAVER',
            self::SERVICE_KEY_VAL => 'UPS_DELI_PL_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER,
            self::RATE_CODE => '65', self::TIN_T_CODE => '26', self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 5, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'AP',
            self::SERVICE_KEY => 'UPS_SP_SERV_PL_AP_EXPRESS',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_AP_EXPRESS',
            self::SERVICE_KEY_VAL => 'UPS_DELI_PL_AP_EXPRESS_VAL',
            self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => '24',
            self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 6, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'AP',
            self::SERVICE_KEY => 'UPS_SP_SERV_PL_AP_EXPRESS_PLUS',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_AP_EXPRESS_PLUS',
            self::SERVICE_KEY_VAL => 'UPS_DELI_PL_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS,
            self::RATE_CODE => '54', self::TIN_T_CODE => '23', self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 7, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'ADD',
            self::SERVICE_KEY => 'UPS_SP_SERV_PL_ADD_STANDARD',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_ADD_STANDARD',
            self::SERVICE_KEY_VAL => 'UPS_DELI_PL_ADD_STANDARD_VAL',
            self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => '25',
            self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 8, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'ADD',
            self::SERVICE_KEY => 'UPS_SP_SERV_PL_ADD_EXPEDITED',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_ADD_EXPEDITED',
            self::SERVICE_KEY_VAL => 'UPS_DELI_PL_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED,
            self::RATE_CODE => '08', self::TIN_T_CODE => '05', self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 9, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'ADD',
            self::SERVICE_KEY => 'UPS_SP_SERV_PL_ADD_EXPRESS_SAVER',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_ADD_EXPRESS_SAVER',
            self::SERVICE_KEY_VAL => 'UPS_DELI_PL_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER,
            self::RATE_CODE => '65', self::TIN_T_CODE => '26', self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 10, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'ADD',
            self::SERVICE_KEY => 'UPS_SP_SERV_PL_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_ADD_EXPRESS',
            self::SERVICE_KEY_VAL => 'UPS_DELI_PL_ADD_EXPRESS_VAL',
            self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => '24',
            self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 11, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'ADD',
            self::SERVICE_KEY => 'UPS_SP_SERV_PL_ADD_EXPRESS_PLUS',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_ADD_EXPRESS_PLUS',
            self::SERVICE_KEY_VAL => 'UPS_DELI_PL_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS,
            self::RATE_CODE => '54', self::TIN_T_CODE => '23', self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 12, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'AP',
            self::SERVICE_KEY => 'UPS_SP_SERV_GB_AP_STANDARD',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_AP_STANDARD',
            self::SERVICE_KEY_VAL => 'UPS_DELI_GB_AP_STANDARD_VAL',
            self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => '68',
            self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 13, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'AP',
            self::SERVICE_KEY => 'UPS_SP_SERV_GB_AP_EXPEDITED',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_AP_EXPEDITED',
            self::SERVICE_KEY_VAL => 'UPS_DELI_GB_AP_EXPEDITED_VAL',
            self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => '05',
            self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 14, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'AP',
            self::SERVICE_KEY => 'UPS_SP_SERV_GB_AP_WW_SAVER',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_AP_WW_SAVER',
            self::SERVICE_KEY_VAL => 'UPS_DELI_GB_AP_WW_SAVER_VAL',
            self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null,
            self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 15, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'AP',
            self::SERVICE_KEY => 'UPS_SP_SERV_GB_AP_EXPRESS',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_AP_EXPRESS',
            self::SERVICE_KEY_VAL => 'UPS_DELI_GB_AP_EXPRESS_VAL',
            self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null,
            self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 16, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'AP',
            self::SERVICE_KEY => 'UPS_SP_SERV_GB_AP_WW_EXPRESS_PLUS',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_AP_WW_EXPRESS_PLUS',
            self::SERVICE_KEY_VAL => 'UPS_DELI_GB_AP_WW_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS,
            self::RATE_CODE => '54', self::TIN_T_CODE => '21', self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 17, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'ADD',
            self::SERVICE_KEY => 'UPS_SP_SERV_GB_ADD_STANDARD',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_ADD_STANDARD',
            self::SERVICE_KEY_VAL => 'UPS_DELI_GB_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD,
            self::RATE_CODE => '11', self::TIN_T_CODE => '68', self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 18, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'ADD',
            self::SERVICE_KEY => 'UPS_SP_SERV_GB_ADD_EXPEDITED',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_ADD_EXPEDITED',
            self::SERVICE_KEY_VAL => 'UPS_DELI_GB_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED,
            self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 19, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'ADD',
            self::SERVICE_KEY => 'UPS_SP_SERV_GB_ADD_WW_SAVER',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_ADD_WW_SAVER',
            self::SERVICE_KEY_VAL => 'UPS_DELI_GB_ADD_WW_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER,
            self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0,
            self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 20, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'ADD',
            self::SERVICE_KEY => 'UPS_SP_SERV_GB_ADD_EXPRESS',
            self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_ADD_EXPRESS',
            self::SERVICE_KEY_VAL => 'UPS_DELI_GB_ADD_EXPRESS_VAL',
            self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
            ['id' => 21, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_GB_ADD_WW_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_ADD_WW_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_GB_ADD_WW_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => '21', self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG]
        ];
        
        $tableName = $setup->getTable('ups_shipping_services');
        $sqlServices = "SELECT id FROM $tableName WHERE `id` = 21";
        $serviceAll = [];
        $query = $setup->getConnection()->query($sqlServices);
        while ($row = $query->fetch()) {
            $serviceAll[] = $row;
        }
        if (empty($serviceAll)) {
            foreach ($dataServices as $data) {
                $setup->getConnection()->insertOnDuplicate($setup->getTable('ups_shipping_services'), $data);
            }
        }

        // install data core_config_data
        $tableName = $setup->getTable('core_config_data');
        $sqlConfig = "SELECT value FROM $tableName WHERE `path` = '".\UPS\Shipping\Helper\Config::CARRIER_UPS_SHIPPING_COUNTRY_CODE."'";
        $configCon = [];
        $query = $setup->getConnection()->query($sqlConfig);
        while ($row = $query->fetch()) {
            $configCon[] = $row;
        }
        if (empty($configCon)) {
            foreach ($dataConfigs as $data) {
                $setup->getConnection()->insertOnDuplicate($setup->getTable('core_config_data'), $data);
            }
        }

        //Update

        $tableName = $setup->getTable('ups_shipping_services');

        // Check if the table already exists
        if ($setup->getConnection()->isTableExists($tableName) == true) {
            $sqlServices = "SELECT id FROM $tableName WHERE `id` = 22";
            $serviceAll = [];
            $query = $setup->getConnection()->query($sqlServices);
            while ($row = $query->fetch()) {
                $serviceAll[] = $row;
            }
            if (empty($serviceAll)) {
                // Declare data
                $dataDEServices = [
                    ['id' => 23, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DE_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 26, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DE_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 27, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DE_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 24, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DE_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 22, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DE_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 25, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DE_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 29, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DE_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 32, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DE_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 33, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 30, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 28, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DE_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 31, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DE_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 34, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FR_AP_AP_ECONOMY', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_AP_AP_ECONOMY', self::SERVICE_KEY_VAL => 'UPS_DELI_FR_AP_AP_ECONOMY_VAL', self::SERVICE_NAME => 'UPS Access Point Economy', self::RATE_CODE => '70', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => '&trade;'],
                    ['id' => 36, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FR_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_FR_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 38, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FR_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_FR_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 39, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FR_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_FR_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 37, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FR_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_FR_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 35, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FR_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_FR_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 41, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_FR_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_FR_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 43, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_FR_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_FR_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 44, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_FR_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_FR_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 42, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_FR_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_FR_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 40, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_FR_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_FR_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 46, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_ES_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 48, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_ES_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 49, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_ES_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 47, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_ES_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 45, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_ES_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 51, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_ES_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 53, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_ES_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 54, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_ES_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 52, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_ES_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 50, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_ES_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 56, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IT_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_IT_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 58, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IT_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_IT_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 59, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IT_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_IT_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 57, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IT_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_IT_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 55, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IT_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_IT_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 61, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IT_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_IT_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 63, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IT_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_IT_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 64, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IT_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_IT_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 62, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_IT_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 60, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IT_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_IT_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 65, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NL_AP_AP_ECONOMY', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_AP_AP_ECONOMY', self::SERVICE_KEY_VAL => 'UPS_DELI_NL_AP_AP_ECONOMY_VAL', self::SERVICE_NAME => 'UPS Access Point Economy', self::RATE_CODE => '70', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => '&trade;'],
                    ['id' => 67, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NL_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_NL_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 69, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NL_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_NL_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 70, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NL_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_NL_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 68, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NL_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_NL_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 66, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NL_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_NL_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 72, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_NL_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_NL_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 74, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_NL_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_NL_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 75, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_NL_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_NL_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 73, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_NL_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_NL_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 71, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_NL_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_NL_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 76, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BE_AP_AP_ECONOMY', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_AP_AP_ECONOMY', self::SERVICE_KEY_VAL => 'UPS_DELI_BE_AP_AP_ECONOMY_VAL', self::SERVICE_NAME => 'UPS Access Point Economy', self::RATE_CODE => '70', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => '&trade;'],
                    ['id' => 78, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BE_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_BE_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 80, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BE_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_BE_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 81, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BE_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_BE_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 79, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BE_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_BE_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 77, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BE_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_BE_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 83, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_BE_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_BE_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 85, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_BE_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_BE_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 86, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_BE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_BE_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 84, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_BE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_BE_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 82, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_BE_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_BE_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG]
                ];

                foreach ($dataDEServices as $data) {
                    $setup->getConnection()->insertOnDuplicate($setup->getTable('ups_shipping_services'), $data);
                }
            }

            $sqlServicesUS = "SELECT id FROM $tableName WHERE `id` = 87";
            $serviceUS = [];
            $queryUS = $setup->getConnection()->query($sqlServicesUS);
            while ($row = $queryUS->fetch()) {
                $serviceUS[] = $row;
            }
            if (empty($serviceUS)) {
                // Declare data
                $dataUSServices = [
                    ['id' => 87, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_GROUND', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_GROUND', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_GROUND_VAL', self::SERVICE_NAME => self::UPS_GROUND, self::RATE_CODE => '03', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 88, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_3_DAY_SELECT', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_3_DAY_SELECT', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_3_DAY_SELECT_VAL', self::SERVICE_NAME => self::UPS_3_DAY_SELECT, self::RATE_CODE => '12', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 89,self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_DAY_AIR', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_DAY_AIR', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_DAY_AIR_VAL', self::SERVICE_NAME => self::UPS_DAY_AIR, self::RATE_CODE => '02', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 90, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_DAY_AIR_AM', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_DAY_AIR_AM', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_DAY_AIR_AM_VAL', self::SERVICE_NAME => self::UPS_DAY_AIR_AM, self::RATE_CODE => '59', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 91, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_AIR_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_AIR_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_AIR_SAVER_VAL', self::SERVICE_NAME => self::UPS_AIR_SAVER, self::RATE_CODE => '13', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 92, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_AIR', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_AIR', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_AIR_VAL', self::SERVICE_NAME => self::UPS_AIR, self::RATE_CODE => '01', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 93, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_AIR_EARLY', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_AIR_EARLY', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_AIR_EARLY_VAL', self::SERVICE_NAME => self::UPS_AIR_EARLY, self::RATE_CODE => '14', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 94, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 95, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_WORLDWIDE_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_WORLDWIDE_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_WORLDWIDE_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 96, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_WORLDWIDE_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_WORLDWIDE_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_WORLDWIDE_SAVER_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 97, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_WORLDWIDE_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_WORLDWIDE_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_WORLDWIDE_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 98, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_WORLDWIDE_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_WORLDWIDE_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_WORLDWIDE_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 99, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_GROUND', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_GROUND', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_GROUND_VAL', self::SERVICE_NAME => self::UPS_GROUND, self::RATE_CODE => '03', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 100, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_3_DAY_SELECT', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_3_DAY_SELECT', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_3_DAY_SELECT_VAL', self::SERVICE_NAME => self::UPS_3_DAY_SELECT, self::RATE_CODE => '12', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 101, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_DAY_AIR', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_DAY_AIR', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_DAY_AIR_VAL', self::SERVICE_NAME => self::UPS_DAY_AIR, self::RATE_CODE => '02', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 102, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_DAY_AIR_AM', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_DAY_AIR_AM', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_DAY_AIR_AM_VAL', self::SERVICE_NAME => self::UPS_DAY_AIR_AM, self::RATE_CODE => '59', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 103, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_AIR_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_AIR_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_AIR_SAVER_VAL', self::SERVICE_NAME => self::UPS_AIR_SAVER, self::RATE_CODE => '13', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 104, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_AIR', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_AIR', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_AIR_VAL', self::SERVICE_NAME => self::UPS_AIR, self::RATE_CODE => '01', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 105, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_AIR_EARLY', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_AIR_EARLY', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_AIR_EARLY_VAL', self::SERVICE_NAME => self::UPS_AIR_EARLY, self::RATE_CODE => '14', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 106, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 107, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_WORLDWIDE_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_WORLDWIDE_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_WORLDWIDE_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 108, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_WORLDWIDE_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_WORLDWIDE_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_WORLDWIDE_SAVER_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 109, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_WORLDWIDE_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_WORLDWIDE_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_WORLDWIDE_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 110, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_WORLDWIDE_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_WORLDWIDE_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_WORLDWIDE_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG]
                ];

                foreach ($dataUSServices as $data) {
                    $setup->getConnection()->insertOnDuplicate($setup->getTable('ups_shipping_services'), $data);
                }
            }

            // Additional the ups_shipping_services
            $dataServices = [
                ['id' => 21, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_GB_ADD_WW_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_ADD_WW_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_GB_ADD_WW_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => '21', self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 25, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DE_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                ['id' => 26, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DE_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 27, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DE_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 31, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DE_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 32, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DE_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 33, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_DE_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 45, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_ES_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 50, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_ES_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_ES_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 62, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_IT_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 87, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_GROUND', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_GROUND', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_GROUND_VAL', self::SERVICE_NAME => self::UPS_GROUND, self::RATE_CODE => '03', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 88, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_3_DAY_SELECT', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_3_DAY_SELECT', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_3_DAY_SELECT_VAL', self::SERVICE_NAME => self::UPS_3_DAY_SELECT, self::RATE_CODE => '12', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 89,self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_DAY_AIR', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_DAY_AIR', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_DAY_AIR_VAL', self::SERVICE_NAME => self::UPS_DAY_AIR, self::RATE_CODE => '02', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 90, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_DAY_AIR_AM', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_DAY_AIR_AM', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_DAY_AIR_AM_VAL', self::SERVICE_NAME => self::UPS_DAY_AIR_AM, self::RATE_CODE => '59', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 91, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_AIR_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_AIR_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_AIR_SAVER_VAL', self::SERVICE_NAME => self::UPS_AIR_SAVER, self::RATE_CODE => '13', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 92, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_AIR', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_AIR', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_AIR_VAL', self::SERVICE_NAME => self::UPS_AIR, self::RATE_CODE => '01', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 93, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_AIR_EARLY', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_AIR_EARLY', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_AIR_EARLY_VAL', self::SERVICE_NAME => self::UPS_AIR_EARLY, self::RATE_CODE => '14', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 94, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 95, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_WORLDWIDE_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_WORLDWIDE_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_WORLDWIDE_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 96, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_WORLDWIDE_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_WORLDWIDE_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_WORLDWIDE_SAVER_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 97, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_WORLDWIDE_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_WORLDWIDE_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_WORLDWIDE_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 98, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_US_AP_WORLDWIDE_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_AP_WORLDWIDE_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_US_AP_WORLDWIDE_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 99, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_GROUND', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_GROUND', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_GROUND_VAL', self::SERVICE_NAME => self::UPS_GROUND, self::RATE_CODE => '03', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 100, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_3_DAY_SELECT', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_3_DAY_SELECT', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_3_DAY_SELECT_VAL', self::SERVICE_NAME => self::UPS_3_DAY_SELECT, self::RATE_CODE => '12', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 101, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_DAY_AIR', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_DAY_AIR', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_DAY_AIR_VAL', self::SERVICE_NAME => self::UPS_DAY_AIR, self::RATE_CODE => '02', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 102, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_DAY_AIR_AM', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_DAY_AIR_AM', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_DAY_AIR_AM_VAL', self::SERVICE_NAME => self::UPS_DAY_AIR_AM, self::RATE_CODE => '59', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 103, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_AIR_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_AIR_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_AIR_SAVER_VAL', self::SERVICE_NAME => self::UPS_AIR_SAVER, self::RATE_CODE => '13', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 104, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_AIR', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_AIR', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_AIR_VAL', self::SERVICE_NAME => self::UPS_AIR, self::RATE_CODE => '01', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 105, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_AIR_EARLY', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_AIR_EARLY', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_AIR_EARLY_VAL', self::SERVICE_NAME => self::UPS_AIR_EARLY, self::RATE_CODE => '14', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 106, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 107, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_WORLDWIDE_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_WORLDWIDE_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_WORLDWIDE_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 108, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_WORLDWIDE_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_WORLDWIDE_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_WORLDWIDE_SAVER_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 109, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_WORLDWIDE_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_WORLDWIDE_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_WORLDWIDE_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG],
                ['id' => 110, self::COUNTRY_CODE => 'US', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_US_ADD_WORLDWIDE_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_US_ADD_WORLDWIDE_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_US_ADD_WORLDWIDE_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_WORLDWIDE_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0, self::SERVICE_SYMBOL => self::SYMBOL_REG]
            ];

            $dataCountry = [
                ['country_id' => 'PR', 'iso2_code' => 'PR', 'iso3_code' => 'PRI']
            ];
            foreach ($dataCountry as $item) {
                $setup->getConnection()->insertOnDuplicate($setup->getTable('directory_country'), $item);
            }

            foreach ($dataServices as $data) {
                $setup->getConnection()->insertOnDuplicate($setup->getTable('ups_shipping_services'), $data);
            }

// entries for countries [Austria, Bulgaria, Croatia, Cyprus, CzechRepublic, Denmark, Estonia, Finland, Greece, Hungary, Ireland, Latvia, Lithuania, Luxembourg, Malta, Portugal, Romania, Slovakia, Slovenia, Sweden]
            $sqlServices = "SELECT id FROM $tableName WHERE `id` = 143";
            $serviceAll = [];
            $query = $setup->getConnection()->query($sqlServices);
            while ($row = $query->fetch()) {
                $serviceAll[] = $row;
            }
            if (empty($serviceAll)) {
                // Declare data
                $dataServices = [
                    ['id' => 143, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_AT_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 144, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_AT_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 145, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_AT_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 146, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_AT_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 147, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_AT_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 148, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_AT_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 149, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_AT_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 150, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_AT_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 151, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_AT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 152, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_AT_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 153, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_AT_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 154, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_AT_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_AT_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 155, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BG_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 156, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BG_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 157, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BG_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 158, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BG_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 159, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BG_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 160, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_BG_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 161, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_BG_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 162, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_BG_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 163, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_BG_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 164, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_BG_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 165, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_BG_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 166, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_BG_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_BG_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 167, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HR_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 168, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HR_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 169, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HR_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 170, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HR_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 171, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HR_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 172, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HR_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 173, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HR_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 174, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HR_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 175, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HR_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 176, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HR_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 177, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HR_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 178, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HR_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_HR_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 179, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CY_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 180, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CY_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 181, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CY_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 182, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CY_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 183, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CY_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 184, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CY_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 185, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CY_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 186, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CY_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 187, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CY_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 188, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CY_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 189, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CY_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 190, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CY_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_CY_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 191, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 192, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 193, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 194, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 195, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 196, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 197, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 198, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 199, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 200, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 201, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 202, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CZ_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 203, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DK_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 204, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DK_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 205, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DK_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 206, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DK_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 207, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DK_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 208, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_DK_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 209, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DK_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 210, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DK_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 211, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DK_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 212, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DK_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 213, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DK_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 214, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_DK_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_DK_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 215, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_EE_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 216, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_EE_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 217, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_EE_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 218, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_EE_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 219, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_EE_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 220, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_EE_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 221, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_EE_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 222, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_EE_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 223, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_EE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 224, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_EE_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 225, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_EE_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 226, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_EE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_EE_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 227, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FI_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 228, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FI_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 229, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FI_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 230, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FI_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 231, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FI_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 232, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_FI_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 233, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_FI_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 234, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_FI_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 235, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_FI_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 236, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_FI_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 237, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_FI_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 238, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_FI_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_FI_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 239, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_GR_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 240, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_GR_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 241, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_GR_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 242, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_GR_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 243, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_GR_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 244, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_GR_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 245, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_GR_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 246, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_GR_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 247, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_GR_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 248, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_GR_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 249, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_GR_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 250, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_GR_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_GR_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 251, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HU_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 252, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HU_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 253, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HU_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 254, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HU_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 255, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HU_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 256, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_HU_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 257, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HU_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 258, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HU_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 259, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HU_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 260, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HU_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 261, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HU_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 262, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_HU_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_HU_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 263, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IE_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 264, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IE_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 265, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IE_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 266, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IE_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 267, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IE_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 268, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IE_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 269, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IE_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 270, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IE_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 271, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 272, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IE_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 273, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IE_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 274, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_IE_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 275, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LV_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 276, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LV_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 277, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LV_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 278, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LV_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 279, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LV_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 280, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LV_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 281, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LV_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 282, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LV_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 283, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LV_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 284, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LV_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 285, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LV_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 286, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LV_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_LV_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 287, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LT_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 288, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LT_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 289, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LT_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 290, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LT_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 291, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LT_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 292, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LT_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 293, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LT_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 294, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LT_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 295, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 296, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LT_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 297, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LT_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 298, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LT_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_LT_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 299, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LU_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 300, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LU_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 301, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LU_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 302, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LU_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 303, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LU_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 304, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_LU_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 305, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LU_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 306, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LU_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 307, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LU_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 308, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LU_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 309, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LU_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 310, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_LU_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_LU_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 311, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_MT_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 312, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_MT_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 313, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_MT_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 314, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_MT_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 315, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_MT_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 316, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_MT_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 317, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_MT_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 318, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_MT_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 319, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_MT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 320, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_MT_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 321, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_MT_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 322, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_MT_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_MT_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 323, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_PT_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 324, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_PT_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 325, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_PT_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 326, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_PT_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 327, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_PT_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 328, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_PT_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 329, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_PT_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 330, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_PT_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 331, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_PT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 332, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_PT_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 333, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_PT_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 334, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_PT_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_PT_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 335, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RO_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 336, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RO_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 337, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RO_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 338, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RO_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 339, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RO_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 340, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RO_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 341, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RO_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 342, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RO_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 343, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RO_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 344, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RO_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 345, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RO_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 346, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RO_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_RO_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 347, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SK_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 348, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SK_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 349, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SK_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 350, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SK_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 351, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SK_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 352, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SK_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 353, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SK_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 354, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SK_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 355, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SK_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 356, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SK_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 357, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SK_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 358, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SK_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_SK_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 359, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SI_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 360, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SI_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 361, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SI_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 362, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SI_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 363, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SI_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 364, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SI_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 365, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SI_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 366, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SI_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 367, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SI_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 368, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SI_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 369, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SI_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 370, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SI_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_SI_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 371, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SE_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 372, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SE_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 373, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SE_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 374, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SE_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 375, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SE_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 376, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_SE_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 377, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SE_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 378, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SE_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 379, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 380, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SE_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 381, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SE_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 382, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_SE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_SE_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG]
                ];

                foreach ($dataServices as $data) {
                    $setup->getConnection()->insertOnDuplicate($setup->getTable('ups_shipping_services'), $data);
                }
            }
            // entries for countries [norway, serbia, switzerland]
            $sqlServices = "SELECT id FROM $tableName WHERE `id` = 463";
            $serviceAll = [];
            $query = $setup->getConnection()->query($sqlServices);
            while ($row = $query->fetch()) {
                $serviceAll[] = $row;
            }
            if (empty($serviceAll)) {
                // Declare data
                $dataServices = [
                    ['id' => 463, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NO_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 464, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NO_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 465, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NO_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 466, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NO_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 467, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NO_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 468, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_NO_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 469, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_NO_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 470, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_NO_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 471, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_NO_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 472, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_NO_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 473, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_NO_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 474, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_NO_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_NO_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 475, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RS_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 476, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RS_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 477, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RS_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 478, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RS_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 479, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RS_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 480, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_RS_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 481, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RS_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 482, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RS_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 483, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RS_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 484, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RS_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 485, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RS_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 486, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_RS_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_RS_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 487, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CH_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 488, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CH_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 489, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CH_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 490, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CH_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 491, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CH_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 492, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_CH_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 493, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CH_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 494, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CH_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 495, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CH_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 496, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CH_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 497, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CH_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 498, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_CH_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_CH_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG]
                ];
                foreach ($dataServices as $data) {
                    $setup->getConnection()->insertOnDuplicate($setup->getTable('ups_shipping_services'), $data);
                }
            }
            // entries for countries [iceland, jersey, turkey]
            $sqlServices = "SELECT id FROM $tableName WHERE `id` = 511";
            $serviceAll = [];
            $query = $setup->getConnection()->query($sqlServices);
            while ($row = $query->fetch()) {
                $serviceAll[] = $row;
            }
            if (empty($serviceAll)) {
                // Declare data
                $dataServices = [
                    ['id' => 511, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IS_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 512, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IS_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 513, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IS_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 514, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IS_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 515, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IS_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 516, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_IS_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 517, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IS_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 518, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IS_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 519, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IS_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 520, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IS_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 521, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IS_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 522, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_IS_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_IS_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 523, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_JE_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 524, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_JE_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 525, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_JE_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 526, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_JE_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 527, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_JE_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 528, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_JE_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 529, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_JE_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 530, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_JE_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 531, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_JE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 532, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_JE_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 533, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_JE_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 534, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_JE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_JE_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 535, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_TR_AP_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_AP_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_AP_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 536, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_TR_AP_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_AP_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_AP_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 537, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_TR_AP_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_AP_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_AP_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 538, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_TR_AP_UPS_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_AP_UPS_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_AP_UPS_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => null],
                    ['id' => 539, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_TR_AP_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_AP_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_AP_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 540, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'AP', self::SERVICE_KEY => 'UPS_SP_SERV_TR_AP_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_AP_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_AP_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 541, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_TR_ADD_STANDARD', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_ADD_STANDARD', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_ADD_STANDARD_VAL', self::SERVICE_NAME => self::UPS_STANDARD, self::RATE_CODE => '11', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 542, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_TR_ADD_EXPEDITED', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_ADD_EXPEDITED', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_ADD_EXPEDITED_VAL', self::SERVICE_NAME => self::UPS_EXPEDITED, self::RATE_CODE => '08', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 543, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_TR_ADD_EXPRESS_SAVER', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_ADD_EXPRESS_SAVER', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_ADD_EXPRESS_SAVER_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_SAVER, self::RATE_CODE => '65', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 544, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_TR_ADD_EXPRESS12', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_ADD_EXPRESS12', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_ADD_EXPRESS12_VAL', self::SERVICE_NAME => self::UPS_EXPRESS12, self::RATE_CODE => '74', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 545, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_TR_ADD_EXPRESS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_ADD_EXPRESS', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_ADD_EXPRESS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS, self::RATE_CODE => '07', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 546, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'ADD', self::SERVICE_KEY => 'UPS_SP_SERV_TR_ADD_EXPRESS_PLUS', self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_ADD_EXPRESS_PLUS', self::SERVICE_KEY_VAL => 'UPS_DELI_TR_ADD_EXPRESS_PLUS_VAL', self::SERVICE_NAME => self::UPS_EXPRESS_PLUS, self::RATE_CODE => '54', self::TIN_T_CODE => null, self::SERVICE_SELECTED => 0 , self::SERVICE_SYMBOL => self::SYMBOL_REG]
                ];
                foreach ($dataServices as $data) {
                    $setup->getConnection()->insertOnDuplicate($setup->getTable('ups_shipping_services'), $data);
                }
            }
        }

        // Check if the table already exists
        if ($setup->getConnection()->isTableExists($tableName) == true) {
            $sqlSatDeliveryService = "SELECT id FROM $tableName WHERE `id` = 111";
            $serviceSatDelivery = [];
            $querySatDelivery = $setup->getConnection()->query($sqlSatDeliveryService);
            while ($row = $querySatDelivery->fetch()) {
                $serviceSatDelivery[] = $row;
            }
            if (empty($serviceSatDelivery)) {
                $saturdayDeliveryServices = [
                    //PL
                    ['id' => 111, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_PL_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_PL_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 112, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_PL_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_PL_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 113, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_PL_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_PL_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 114, self::COUNTRY_CODE => 'PL', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_PL_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PL_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_PL_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    //GB
                    ['id' => 115, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_GB_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_GB_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 116, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_GB_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_GB_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 117, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_GB_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_GB_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 118, self::COUNTRY_CODE => 'GB', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_GB_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GB_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_GB_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    //DE
                    ['id' => 119, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_DE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_DE_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 120, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_DE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_DE_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 121, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_DE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_DE_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 122, self::COUNTRY_CODE => 'DE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_DE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_DE_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    //FR
                    ['id' => 123, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_FR_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_FR_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 124, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_FR_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_FR_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 125, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_FR_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_FR_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 126, self::COUNTRY_CODE => 'FR', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_FR_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FR_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_FR_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    //ES
                    ['id' => 127, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_ES_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_ES_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 128, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_ES_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_ES_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 129, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_ES_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_ES_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 130, self::COUNTRY_CODE => 'ES', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_ES_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_ES_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_ES_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    //IT
                    ['id' => 131, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IT_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IT_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 132, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IT_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IT_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 133, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IT_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IT_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 134, self::COUNTRY_CODE => 'IT', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IT_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IT_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IT_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    //NL
                    ['id' => 135, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_NL_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_NL_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 136, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_NL_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_NL_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 137, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_NL_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_NL_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 138, self::COUNTRY_CODE => 'NL', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_NL_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NL_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_NL_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    //BE
                    ['id' => 139, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_BE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_BE_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 140, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_BE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_BE_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 141, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_BE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_BE_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 142, self::COUNTRY_CODE => 'BE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_BE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_BE_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG]
                ];
                foreach ($saturdayDeliveryServices as $data) {
                    $setup->getConnection()->insertOnDuplicate($tableName, $data);
                }
            }
            // entries for countries [Austria, Bulgaria, Croatia, Cyprus, CzechRepublic, Denmark, Estonia, Finland, Greece, Hungary, Ireland, Latvia, Lithuania, Luxembourg, Malta, Portugal, Romania, Slovakia, Slovenia, Sweden]
            $sqlSatDeliveryService = "SELECT id FROM $tableName WHERE `id` = 383";
            $serviceSatDelivery = [];
            $querySatDelivery = $setup->getConnection()->query($sqlSatDeliveryService);
            while ($row = $querySatDelivery->fetch()) {
                $serviceSatDelivery[] = $row;
            }
            if (empty($serviceSatDelivery)) {
                $saturdayDeliveryServices = [
                    //AT
                    ['id' => 383, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_AT_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_AT_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 384, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_AT_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_AT_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 385, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_AT_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_AT_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 386, self::COUNTRY_CODE => 'AT', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_AT_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_AT_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_AT_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // BG
                    ['id' => 387, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_BG_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_BG_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 388, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_BG_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_BG_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 389, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_BG_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_BG_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 390, self::COUNTRY_CODE => 'BG', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_BG_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_BG_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_BG_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // HR
                    ['id' => 391, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_HR_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_HR_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 392, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_HR_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_HR_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 393, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_HR_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_HR_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 394, self::COUNTRY_CODE => 'HR', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_HR_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HR_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_HR_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // CY
                    ['id' => 395, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CY_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CY_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 396, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CY_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CY_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 397, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CY_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CY_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 398, self::COUNTRY_CODE => 'CY', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CY_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CY_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CY_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // CZ
                    ['id' => 399, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CZ_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 400, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CZ_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 401, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CZ_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 402, self::COUNTRY_CODE => 'CZ', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CZ_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CZ_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CZ_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // DK
                    ['id' => 403, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_DK_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_DK_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 404, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_DK_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_DK_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 405, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_DK_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_DK_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 406, self::COUNTRY_CODE => 'DK', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_DK_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_DK_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_DK_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // EE
                    ['id' => 407, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_EE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_EE_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 408, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_EE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_EE_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 409, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_EE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_EE_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 410, self::COUNTRY_CODE => 'EE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_EE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_EE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_EE_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // FI
                    ['id' => 411, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_FI_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_FI_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 412, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_FI_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_FI_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 413, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_FI_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_FI_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 414, self::COUNTRY_CODE => 'FI', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_FI_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_FI_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_FI_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // GR
                    ['id' => 415, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_GR_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_GR_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 416, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_GR_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_GR_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 417, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_GR_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_GR_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 418, self::COUNTRY_CODE => 'GR', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_GR_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_GR_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_GR_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // HU
                    ['id' => 419, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_HU_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_HU_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 420, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_HU_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_HU_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 421, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_HU_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_HU_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 422, self::COUNTRY_CODE => 'HU', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_HU_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_HU_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_HU_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // IE
                    ['id' => 423, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IE_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 424, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IE_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 425, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IE_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 426, self::COUNTRY_CODE => 'IE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IE_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // LV
                    ['id' => 427, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LV_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LV_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 428, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LV_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LV_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 429, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LV_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LV_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 430, self::COUNTRY_CODE => 'LV', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LV_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LV_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LV_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // LT
                    ['id' => 431, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LT_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LT_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 432, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LT_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LT_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 433, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LT_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LT_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 434, self::COUNTRY_CODE => 'LT', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LT_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LT_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LT_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // LU
                    ['id' => 435, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LU_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LU_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 436, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LU_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LU_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 437, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LU_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LU_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 438, self::COUNTRY_CODE => 'LU', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_LU_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_LU_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_LU_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // MT
                    ['id' => 439, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_MT_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_MT_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 440, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_MT_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_MT_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 441, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_MT_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_MT_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 442, self::COUNTRY_CODE => 'MT', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_MT_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_MT_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_MT_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // PT
                    ['id' => 443, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_PT_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_PT_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 444, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_PT_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_PT_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 445, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_PT_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_PT_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 446, self::COUNTRY_CODE => 'PT', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_PT_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_PT_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_PT_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // RO
                    ['id' => 447, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_RO_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_RO_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 448, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_RO_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_RO_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 449, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_RO_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_RO_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 450, self::COUNTRY_CODE => 'RO', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_RO_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RO_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_RO_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // SK
                    ['id' => 451, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SK_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SK_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 452, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SK_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SK_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 453, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SK_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SK_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 454, self::COUNTRY_CODE => 'SK', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SK_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SK_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SK_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // SI
                    ['id' => 455, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SI_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SI_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 456, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SI_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SI_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 457, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SI_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SI_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 458, self::COUNTRY_CODE => 'SI', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SI_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SI_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SI_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    // SE
                    ['id' => 459, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SE_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 460, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SE_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 461, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SE_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 462, self::COUNTRY_CODE => 'SE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_SE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_SE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_SE_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG]
                ];
                foreach ($saturdayDeliveryServices as $data) {
                    $setup->getConnection()->insertOnDuplicate($tableName, $data);
                }
            }

            // entries for countries [norway, serbia, switzerland]
            $sqlSatDeliveryService = "SELECT id FROM $tableName WHERE `id` = 499";
            $serviceSatDelivery = [];
            $querySatDelivery = $setup->getConnection()->query($sqlSatDeliveryService);
            while ($row = $querySatDelivery->fetch()) {
                $serviceSatDelivery[] = $row;
            }
            if (empty($serviceSatDelivery)) {
                $saturdayDeliveryServices = [
                    //NO
                    ['id' => 499, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_NO_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_NO_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 500, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_NO_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_NO_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 501, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_NO_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_NO_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 502, self::COUNTRY_CODE => 'NO', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_NO_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_NO_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_NO_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    //RS
                    ['id' => 503, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_RS_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_RS_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 504, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_RS_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_RS_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 505, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_RS_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_RS_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 506, self::COUNTRY_CODE => 'RS', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_RS_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_RS_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_RS_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    //CH
                    ['id' => 507, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CH_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CH_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 508, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CH_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CH_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 509, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CH_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CH_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 510, self::COUNTRY_CODE => 'CH', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_CH_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_CH_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_CH_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG]
                ];
                foreach ($saturdayDeliveryServices as $data) {
                    $setup->getConnection()->insertOnDuplicate($tableName, $data);
                }
            }
            // entries for countries [iceland, jersey, turkey]
            $sqlSatDeliveryService = "SELECT id FROM $tableName WHERE `id` = 547";
            $serviceSatDelivery = [];
            $querySatDelivery = $setup->getConnection()->query($sqlSatDeliveryService);
            while ($row = $querySatDelivery->fetch()) {
                $serviceSatDelivery[] = $row;
            }
            if (empty($serviceSatDelivery)) {
                $saturdayDeliveryServices = [
                    //IS
                    ['id' => 547, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IS_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IS_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 548, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IS_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IS_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 549, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IS_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IS_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 550, self::COUNTRY_CODE => 'IS', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_IS_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_IS_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_IS_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    //JE
                    ['id' => 551, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_JE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_JE_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 552, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_JE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_JE_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 553, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_JE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_JE_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 554, self::COUNTRY_CODE => 'JE', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_JE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_JE_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_JE_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    //TR
                    ['id' => 555, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_TR_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_AP_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_TR_AP_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 556, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'AP',
                        self::SERVICE_KEY => 'UPS_SP_SERV_TR_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_AP_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_TR_AP_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 557, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_TR_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_ADD_STANDARD_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_TR_ADD_STANDARD_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_STANDARD_SAT_DELI,
                        self::RATE_CODE => '11', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG],
                    ['id' => 558, self::COUNTRY_CODE => 'TR', self::SERVICE_TYPE => 'ADD',
                        self::SERVICE_KEY => 'UPS_SP_SERV_TR_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_DELIVERY => 'UPS_DELI_TR_ADD_EXPRESS_SAT_DELI',
                        self::SERVICE_KEY_VAL => 'UPS_DELI_TR_ADD_EXPRESS_SAT_DELI_VAL',
                        self::SERVICE_NAME => self::UPS_EXPRESS_SAT_DELI,
                        self::RATE_CODE => '07', self::TIN_T_CODE => '0', self::SERVICE_SELECTED => 0,
                        self::SERVICE_SYMBOL => self::SYMBOL_REG]
                ];
                foreach ($saturdayDeliveryServices as $data) {
                    $setup->getConnection()->insertOnDuplicate($tableName, $data);
                }
            }
        }
        $this->moduleDataSetup->getConnection()->endSetup();
        
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * InstallData generateMerchantKey
     * calculate shipping service
     *
     * @return array $data
     */
    public function generateMerchantKey()
    {
        $randmax_bits = strlen(base_convert((string)mt_getrandmax(), 10, 2));
        $x = '';

        while (strlen($x) < 128) {
            $maxbits = (128 - strlen($x) < $randmax_bits) ? 128 - strlen($x) :  $randmax_bits;
            $x .= str_pad(base_convert((string)random_int(9999999, 999999999), 10, 2), $maxbits, "0", STR_PAD_LEFT);
        }

        $x .= str_pad(base_convert((string)random_int(9999999, 999999999), 10, 2), $maxbits, "0", STR_PAD_LEFT);
        $a = [];
        $a['time_low_part'] = substr($x, 0, 32);
        $a['time_mid'] = substr($x, 32, 16);
        $a[self::TIME_HI_AND_VERSION] = substr($x, 48, 16);
        $a[self::CLOCK_SEQ] = substr($x, 64, 16);
        $a['node_part'] =  substr($x, 80, 48);

        $a[self::TIME_HI_AND_VERSION] = substr_replace($a[self::TIME_HI_AND_VERSION], '0100', 0, 4);
        $a[self::CLOCK_SEQ] = substr_replace($a[self::CLOCK_SEQ], '10', 0, 2);

        $timeLowPart = str_pad(base_convert((string)$a['time_low_part'], 2, 16), 8, "0", STR_PAD_LEFT);
        $timeMid = str_pad(base_convert((string)$a['time_mid'], 2, 16), 4, "0", STR_PAD_LEFT);
        $timeHiVersion = str_pad(base_convert((string)$a[self::TIME_HI_AND_VERSION], 2, 16), 4, "0", STR_PAD_LEFT);
        $clockSeq = str_pad(base_convert((string)$a[self::CLOCK_SEQ], 2, 16), 4, "0", STR_PAD_LEFT);
        $noPart = str_pad(base_convert((string)$a['node_part'], 2, 16), 12, "0", STR_PAD_LEFT);
        return sprintf('%s-%s-%s-%s-%s', $timeLowPart, $timeMid, $timeHiVersion, $clockSeq, $noPart);
    }

    public static function getVersion()
    {
        return '1.0.0';
    }
}
