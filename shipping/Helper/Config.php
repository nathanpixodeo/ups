<?php
/**
 * Config file
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
namespace UPS\Shipping\Helper;

/**
 * Config class
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
class Config
{
    //use on block, controller \UPS\Shipping\Helper\Config::carriers_UPS_SHIPPING_COUNTRY_CODE
    const SEARCH_ADDRESS_POINT_URL = 'https://www.ups.com/dropoff';

    /**
     * Define variable constant
     */
    const CARRIER_UPS_SHIPPING_COUNTRY_CODE = "carriers/upsshipping/country_code";
    const ADULT_SIGNATURE = "adult/signature";
    const CARRIER_UPS_SHIPPING_ACCEPT_TERM_CONDITION = "carriers/upsshipping/accept_term_condition";
    const CARRIER_UPS_SHIPPING_ACCEPT_ACCOUNT = "carriers/upsshipping/accept_account";
    const CARRIER_UPS_SHIPPING_ACCEPT_SHIPPING_SERVICE = "carriers/upsshipping/accept_shipping_service";
    const CARRIER_UPS_SHIPPING_ACCEPT_CASH_ON_DELIVERY = "carriers/upsshipping/accept_cash_on_delivery";
    const CARRIER_UPS_SHIPPING_ACCEPT_ACCESSORIAL = "carriers/upsshipping/accept_accessorial";
    const CARRIER_UPS_SHIPPING_ACCEPT_PACKAGE_DIMENSIONS = "carriers/upsshipping/accept_package_dimension";
    const CARRIER_UPS_SHIPPING_ACCEPT_INCLUDE_DIMENSIONS = "carriers/upsshipping/accept_include_dimension";
    const CARRIER_UPS_SHIPPING_ACCEPT_DELIVERY_RATES = "carriers/upsshipping/accept_delivery_rates";
    const CARRIER_UPS_SHIPPING_ACCEPT_BILLING_PREFERENCE = "carriers/upsshipping/accept_billing_preference";
    const CARRIER_UPS_SHIPPING_SHOW_TERM_CONDITION = "carriers/upsshipping/show_term_condition";
    const SERVICE_UPS_ACCOUNT_LOCATION = "general/locale/code";
    const BACKUP_RATE_ERROR_CODE = ['110548','111030','111031','111035','111036','111050','111055','111056','111057','111500','111546','111547','111548','112117','112118','112119','112120','9110054','9110055','9110056','9110057', '9110023', '110002'];

    const PACKGAGE_DEMENSION_COUNT = [];

    const SERVICE_UPS_SHIPPING_PACKALGO = "service/upsshipping/packalgo";
    const SERVICE_UPS_SHIPPING_PACKWEGUNIT = "service/upsshipping/packwegunit";
    const SERVICE_UPS_SHIPPING_PACKDIMUNIT = "service/upsshipping/packdimunit";
    const SERVICE_UPS_SHIPPING_PACKMAXWEG = "service/upsshipping/packmaxweg";
    const SERVICE_UPS_SHIPPING_DELIVERY_TO_ACCESS_POINT = "service/upsshipping/delivery_to_access_point";
    const SERVICE_UPS_SHIPPING_DELIVERY_SET_DEFAULT = "service/upsshipping/set_default";
    const SERVICE_UPS_SHIPPING_DELIVERY_SET_AP_AS_SHIP = "service/upsshipping/set_ap_as_ship";
    const SERVICE_UPS_SHIPPING_UPS_EXPEDITED = "service/upsshipping/ups_expedited";
    const SERVICE_UPS_SHIPPING_UPS_EXPRESS = "service/upsshipping/ups_express";
    const SERVICE_UPS_SHIPPING_UPS_STANDARD = "service/upsshipping/ups_standard";
    const SERVICE_UPS_SHIPPING_UPS_WORLDWIDE_EXPRESS_PLUSS = "service/upsshipping/ups_worldwide_express_pluss";
    const SERVICE_UPS_SHIPPING_NUMBER_OF_ACCESS_POINT_AVAIABLE = "service/upsshipping/number_of_access_point_avaiable";
    const SERVICE_UPS_SHIPPING_DISPLAY_ALL_ACCESS_POINT_IN_RANGE
        = "service/upsshipping/display_all_access_point_in_range";
    const SERVICE_UPS_SHIPPING_CHOOSE_ACCOUNT_NUMBER_AP = "service/upsshipping/choose_account_number_ap";
    const SERVICE_UPS_SHIPPING_CHOOSE_ACCOUNT_NUMBER_ADD = "service/upsshipping/choose_account_number_add";
    const SERVICE_UPS_SHIPPING_DELIVERY_TO_SHIPPING_ADDRESS = "service/upsshipping/delivery_to_shipping_address";
    const SERVICE_UPS_SHIPPING_CUT_OFF_TIME = "service/upsshipping/cut_off_time";

    const CASH_ON_DELIVERY_UPS_SHIPPING_ACTIVE = "payment/cashondelivery/active";
    const CASH_ON_DELIVERY_UPS_SHIPPING_OPTION_ACTIVE = "payment/cashondelivery/option/active";

    const ACCESSORIAL_UPS_SHIPPING_ADDITIONAL_HANDLING = "accessorial/upsshipping/additional_handling";
    const ACCESSORIAL_UPS_SHIPPING_QUANTUM_VIEW_SHIP_NOTIFICATION
        = "accessorial/upsshipping/quantum_view_ship_notification";
    const ACCESSORIAL_UPS_SHIPPING_QUANTUM_VIEW_DELIVARY_NOTIFICATION
        = "accessorial/upsshipping/quantium_view_delivery_notification";
    const ACCESSORIAL_UPS_SHIPPING_RESIDENTIAL_ADDRESS = "accessorial/upsshipping/residential_address";
    const ACCESSORIAL_UPS_SHIPPING_CARBON_NEUTRAL = "accessorial/upsshipping/carbon_neutral";
    const ACCESSORIAL_UPS_SHIPPING_DIRECT_DELIVERY_ONLY = "accessorial/upsshipping/direct_delivery_only";
    const ACCESSORIAL_UPS_SHIPPING_SIGNATURE_REQUIRED = "accessorial/upsshipping/signature_required";
    const ACCESSORIAL_UPS_SHIPPING_ADUL_SIGNATURE_REQUIRED = "accessorial/upsshipping/adul_signature_required";

    const DELIVERY_RATES_UPS_SHIPPING_CURRENCY = "delivery_rates/upsshipping/currency";
    const DELIVERY_RATES_UPS_SHIPPING_STANDARD_SHIPPING = "delivery_rates/upsshipping/standard_shipping";
    const DELIVERY_RATES_UPS_SHIPPING_STANDARD_SHIPPING_RATES = "delivery_rates/upsshipping/standard_shipping_rates";
    const DELIVERY_RATES_UPS_SHIPPING_EXPRESS_SHIPPING = "delivery_rates/upsshipping/express_shipping";
    const DELIVERY_RATES_UPS_SHIPPING_DELIVERY_RATE_ON_TIME = "delivery_rates/upsshipping/delivery_rate_on_time";
    const DELIVERY_RATES_UPS_SHIPPING_EXPRESS_SAVER = "delivery_rates/upsshipping/express_saver";
    const DELIVERY_RATES_UPS_SHIPPING_SHIPTO_STANDARD_SHIPPING = "delivery_rates/upsshipping/shipto_standard_shipping";
    const DELIVERY_RATES_UPS_SHIPPING_SHIPTO_EXPRESS_SHIPPING = "delivery_rates/upsshipping/shipto_express_shipping";
    const DELIVERY_RATES_UPS_SHIPPING_SHIPTO_EXPRESS_SAVER = "delivery_rates/upsshipping/shipto_express_saver";
    const MAP_KEY = "AnC69Phz8JET7DTYatzzOqIXtDUbWM0A1bFMW6T-YBSaCUvI56fpD2hDzdZOUwZH";

    const DELIVERY_RATES_CURRENCY_DEFAULT = "currency/options/default";

    const SALES_ORDER_SHIPPING_METHOD = "upsshipping_upsshipping";

    const SALES_ORDER_SHIPPING_STATUS = ["pending","processing_in_progress", "processing"];

    const REGEX_VALIDATE = [
        'alphanum' => '/^[a-zA-Z0-9]*$/',
        'alpha' => '/^[a-zA-Z]*$/',
        'number' => '/^\s*-?\d*(\.\d*)?\s*$/',
        'numberInt' => '/^\d+$/',
        'numberFloat' => '/^\d+(\.\d{1,2})?$/',
        'email' => '/[a-z0-9._%+-]+@[a-z0-9]+\.[a-z]{2,3}$/',
        'phone' => '/[0|\+][0-9]+/',
        'postalCode' => '/[0-9]{2}[\-][0-9]{3}/',
        'accountNumber' => '/[A-Za-z0-9]{6}/',
        'invoiceNumber' => '/^[^-\s][\w\s-]+$/',
        'invoiceAmount' => '/^[0-9]+\.?[0-9]*$/',
        'validateNull' => '/^\D+$/',
        'address' => '/^\D+$/',
        'date' => '/^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/'
    ];

    const LIST_CLEAR_CACHE = ['config','layout','block_html','full_page'];
    const LIST_TITLE_ACCOUNT = ['Mr', 'Miss', 'Mrs', 'Ms'];
    const LIST_TITLE_ACCOUNT_POLISH = ['Mr', 'Mrs'];
    const LIST_TITLE_ACCOUNT_SPANISH = ['Mr', 'Miss', 'Mrs'];

    const LIST_CURRENCIES = [
        "AED" => "Arab Emirates Dirham",
        "ARS" => "Argentina Peso",
        "AUD" => "Australian Dollar",
        "BBD" => "Barbados Dollar",
        "BHD" => "Bahrain Dinar",
        "BRL" => "Brazilian Real",
        "BYN" => "Belarus Ruble",
        "CAD" => "Canadian Dollar",
        "CHF" => "Swiss Franc",
        "CLP" => "Chilean Peso",
        "CNY" => "China Renminbi Yuan",
        "COP" => "Colombian Peso",
        "CRC" => "Costa Rican Colon",
        "CZK" => "Czech Koruna",
        "DKK" => "Danish Kroner",
        "DOP" => "Dom Rep Peso",
        "EUR" => "Euro",
        "GBP" => "Pound Sterling",
        "HKD" => "Hong Kong Dollar",
        "HUF" => "Hungarian Forint",
        "IDR" => "Indonesian Rupiah",
        "INR" => "Indian Rupee",
        "JPY" => "Japanese Yen",
        "KWD" => "Kuwait Dinar",
        "KRW" => "Korean Won",
        "KZT" => "Kazakhstan Tenge",
        "MAD" => "Morocco Dirham",
        "MOP" => "Macau Pataca",
        "MXN" => "Mexican Peso",
        "MYR" => "Malaysian Ringgit",
        "NGN" => "Nigerian Naira",
        "NOK" => "Norway Kroner",
        "NZD" => "New Zealand Dollar",
        "PAB" => "Panamanian Balboa",
        "PHP" => "Philippine Peso",
        "PLN" => "Polish Zloty",
        "RON" => "Romanian Leu",
        "RUB" => "Russia Ruble",
        "SEK" => "Swedish Kroner",
        "SGD" => "Singapore Dollar",
        "THB" => "Thailand Baht",
        "TRY" => "Turkey",
        "TWD" => "Taiwan Dollar",
        "VND" => "Vietnam dong",
        "UAH" => "Ukraine Hyrvnya",
        "USD" => "U.S. Dollar",
        "ZAR" => "South African Rand",
        "BGN" => "Bulgarian lev",
        "HRK" => "Croatian Kuna",
        "RSD" => "Serbian Dinar",
        "ISK" => "Iceland Krona",
        "TRY" => "New Turkish Lira"
    ];

    //Shipment
    const SHIP_TO_SERVICE_AP = "To Access Point COD";
    const SHIP_TO_SERVICE_ADD = "To Home COD";
    const PAGINATION_NUMBER_ITEM_ON_PAGE = 50;
    const NAME_PRINT_LABEL = "LabelShipment";
    const COD_MAGENTO = 'cashondelivery';

    // Plugin Infor
    const DATE_RELEASE = '02/21/2023';
    const VERSION_PLUGIN = '3.5.3';
    const API_URL = 'upsshipping/eshopper/UpsServiceLink';
    const VERSION_FLATFORM = '2.3, 2.4';
    const NAME_FLATFORM = 'Magento';
    const UPS_SHIPPING_MODULE = 'UPS Access Point and Shipping: Official Module';
    const UPS_MERCHANTKEY = 'ups/merchant/key';
    const PRE_REGISTERED_PLUGIN_TOKEN = 'ups/bearer/retoken';
    const UPS_SERVICE_LINK_SECURITY_TOKEN = 'ups/handshake/key';
    const UPS_SERVICE_LONG_SECURITY_TOKEN = 'ups/bearer/token';
    const UPS_BING_MAPS_KEY = 'ups/bingmaps/key';
    const PUSH_PRE_REGISTRATION_TOKEN = 'PushPreRegistrationToken';
    const UPS_WEBSECUREURL = 'web/secure/base_url';
    const UPS_MERCHANTINFO_EXIST = 'merchant/info/exist';
    const UPS_PLUGIN_MERCHANTINFO_EXIST = 'merchant/plugin/exist';
    const POLAND_API_CODE = 'PLN';
    const STATUS_ARCHIVE_ORDER = 'Canceled';
    const UPS_DELIVERYRATES_EXIST = 'delivery/rates/exist';
    const DAY_ARCHIVE_ORDER = "90";
    const DAY_REMOVE_ORDER = "90";
    const DAY_REMOVE_SHIPMENT = "90";
    const DAY_REMOVE_RETRY = "10";
    const LIMIT_RETRY = "5";
    //const UAT_STRING = 'bc2ups-uat.fsoft.com.vn';
    const UAT_STRING = 'mo.hitactivity.com';
    const CREATE_SHIPMENT_STATUS = "Status not available";
    const VIEW_SHIPMENT_STATUS = "Delivered";
    const CANCEL_SHIPMENT_STATUS = "processing_in_progress";
    const UPS_READY_PLUGIN_VERSION = "ups/ready/plugin/version";
    //UpsReadyPluginVersion

    // Shipment manage
    const STYLE_IMG_1 = '<img style="width:70%; opacity: 0.2;" src="';
    const STYLE_IMG_2 = '<img style="width:70%" src="';
    // save shipping service
    const COUNTRY_US = 'en_US';
    const CONFIG_COUNTRY_US = 'US';
    const LOWER_CONFIG_COUNTRY_US = 'us';
    const CONFIGCOUNTRY = 'GB';
    const CONFIGAP = 'configAP';
    const SERVICEAP = 'serviceAP';
    const CONFIGADD = 'configADD';
    const SERVICEADD = 'serviceADD';
    const ISVALIDCODE001 = '001';
    const ISVALIDCODE011 = '011';
    const ISVALIDCODE013 = '013';
    //CA, MX, PR và US
    const ARRAYLANGUAGECODE = ['de','it','nl'];
    const ARRAYCOUNTRYCODE = ['CA', 'MX', 'PR', 'US'];
    const ARRAYRATECODE = ['54','07','08','65','11'];
    const ARRAY_RATECODE_TO_US = ['54','07','08','65','11'];
    const POLANDLANGUAGECODE = 'pl';
    // ['BE', 'NL', 'FR', 'ES', 'PL', 'IT', 'DE', 'GB', 'AT', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'GR', 'HU', 'IE', 'LV', 'LT', 'LU', 'MT', 'PT', 'RO', 'SK', 'SI', 'SE', 'NO', 'RS', 'CH', 'IS', 'JE', 'TR'];
    const LISTEUCOUNTRY = ['BE', 'NL', 'FR', 'ES', 'PL', 'IT', 'DE', 'GB', 'AT', 'CZ', 'DK', 'FI', 'GR', 'HU', 'IE', 'LU', 'PT', 'RO', 'SI', 'SE', 'NO', 'CH', 'IS', 'JE', 'TR'];
    const LISTSTATECOUNTRY = ['US', 'CA', 'IE'];
    const LISTEUCOUNTRYS = ['FR', 'PL', 'BE', 'NL', 'ES', 'IT', 'DE', 'GB', 'AT', 'CZ', 'DK', 'FI', 'GR', 'HU', 'IE', 'LU', 'PT', 'RO', 'SI', 'SE', 'NO', 'CH', 'IS', 'JE', 'TR'];
    const LISTEULANGUAGES = ['pl_PL','de_DE','fr_BE','fr_FR','nl_BE','es_ES','it_IT','nl_NL'];
    const LISTDIALECTS = [
        'BE' => ['Euro','EUR'],
        'NL' => ['Euro','EUR'],
        'FR' => ['Euro','EUR'],
        'ES' => ['Euro','EUR'],
        'PL' => ['Zloty','PLN'],
        'IT' => ['Euro','EUR'],
        'DE' => ['Euro','EUR'],
        'GB' => ['Pound Sterling','GBP'],
        'US' => ['US Dollar','USD'],
        'AT' => ['Euro','EUR'],
        'BG' => ['Bulgarian lev', 'BGN'],
        'HR' => ['Croatian Kuna', 'HRK'],
        'CY' => ['Euro','EUR'],
        'CZ' => ['Czech Koruna', 'CZK'],
        'DK' => ['Danish Krone', 'DKK'],
        'EE' => ['Euro','EUR'],
        'FI' => ['Euro','EUR'],
        'GR' => ['Euro','EUR'],
        'HU' => ['Forint', 'HUF'],
        'IE' => ['Euro','EUR'],
        'LV' => ['Euro','EUR'],
        'LT' => ['Euro','EUR'],
        'LU' => ['Euro','EUR'],
        'MT' => ['Euro','EUR'],
        'PT' => ['Euro','EUR'],
        'RO' => ['New Leu', 'RON'],
        'SK' => ['Euro','EUR'],
        'SI' => ['Euro','EUR'],
        'SE' => ['Swedish Krona', 'SEK'],
        'NO' => ['Norwegian Krone', 'NOK'],
        'RS' => ['Serbian Dinar', 'RSD'],
        'CH' => ['Swiss Franc', 'CHF'],
        'IS' => ['Iceland Krona', 'ISK'],
        'JE' => ['Pound Sterling','GBP'],
        'TR' => ['New Turkish Lira', 'TRY']
    ];
    const LISTCURRENCYS = [
        'BE' => ['Euro','EUR'],
        'NL' => ['Euro','EUR'],
        'FR' => ['Euro','EUR'],
        'ES' => ['Euro','EUR'],
        'PL' => ['Zloty','PLN'],
        'IT' => ['Euro','EUR'],
        'DE' => ['Euro','EUR'],
        'GB' => ['Pound Sterling','GBP'],
        'US' => ['US Dollar','USD'],
        'AT' => ['Euro','EUR'],
        'BG' => ['Bulgarian lev', 'BGN'],
        'HR' => ['Croatian Kuna', 'HRK'],
        'CY' => ['Euro','EUR'],
        'CZ' => ['Czech Koruna', 'CZK'],
        'DK' => ['Danish Krone', 'DKK'],
        'EE' => ['Euro','EUR'],
        'FI' => ['Euro','EUR'],
        'GR' => ['Euro','EUR'],
        'HU' => ['Forint', 'HUF'],
        'IE' => ['Euro','EUR'],
        'LV' => ['Euro','EUR'],
        'LT' => ['Euro','EUR'],
        'LU' => ['Euro','EUR'],
        'MT' => ['Euro','EUR'],
        'PT' => ['Euro','EUR'],
        'RO' => ['New Leu', 'RON'],
        'SK' => ['Euro','EUR'],
        'SI' => ['Euro','EUR'],
        'SE' => ['Swedish Krona', 'SEK'],
        'NO' => ['Norwegian Krone', 'NOK'],
        'RS' => ['Serbian Dinar', 'RSD'],
        'CH' => ['Swiss Franc', 'CHF'],
        'IS' => ['Iceland Krona', 'ISK'],
        'JE' => ['Pound Sterling','GBP'],
        'TR' => ['New Turkish Lira', 'TRY']
    ];
    const DEFAULT_LOCATION = [
        'BE' => [50.844391, 4.35609],
        'NL' => [52.373055, 4.892222],
        'FR' => [48.85717, 2.3414],
        'ES' => [40.42028, -3.70577],
        'PL' => [52.2356, 21.01037],
        'IT' => [41.903221, 12.49565],
        'DE' => [52.516041, 13.37691],
        'GB' => [51.50632, -0.12714],
        'US' => [47.411297, -120.556267],
        'AT' => [48.210033, 16.363449],
        'BG' => [42.698334, 23.319941],
        'HR' => [45.815399, 15.966568],
        'CY' => [35.095192, 33.203430],
        'CZ' => [50.073658, 14.418540],
        'DK' => [55.676098, 12.568337],
        'EE' => [59.379913, 28.191261],
        'FI' => [60.192059, 24.945831],
        'GR' => [37.983810, 23.727539],
        'HU' => [47.497913, 19.040236],
        'IE' => [53.350140, 6.266155],
        'LV' => [56.946285, 24.105078],
        'LT' => [54.687157, 25.279652],
        'LU' => [49.611622, 6.131935],
        'MT' => [35.917973, 14.409943],
        'PT' => [38.736946, -9.142685],
        'RO' => [44.439663, 26.096306],
        'SK' => [48.148598, 17.107748],
        'SI' => [46.056946, 14.505751],
        'SE' => [59.334591, 18.063240],
        'NO' => [61.665609, 9.688318],
        'RS' => [44.012368, 20.921124],
        'CH' => [46.748412, 8.095468],
        'IS' => [64.137137, -20.325936],
        'JE' => [49.226937, -2.145567],
        'TR' => [38.770222, 35.288987]
    ];
    const UPS_SHIPPING_DELIVERY = 'ups_shipping_delivery';
    const UPS_SHIPPING_LICENSE = 'ups_shipping_license';
    const UPS_SHIPPING_LOGAPI = 'ups_shipping_logapi';
    const UPS_SHIPPING_ACCESSORIAL = 'ups_shipping_accessorial';
    const UPS_SHIPPING_ACCOUNT = 'ups_shipping_account';
    const UPS_SHIPPING_ORDERS = 'ups_shipping_orders';
    const UPS_SHIPPING_PACKAGE = 'ups_shipping_package';
    const SUPPORT_PHONE = [
        'BE' => "+32 78 48 49 16",
        'NL' => "+31 85 107 0232",
        'FR' => "+33 805 11 96 92",
        'ES' => "+34 518 90 05 99",
        'PL' => "+48 22 103 24 55",
        'IT' => "+39 800 725 920",
        'DE' => "+49 32 221097485",
        'GB' => "+44 808 258 0323",
        'US' => "",
        'AT' => "+49 32 221097485",
        'BG' => "+49 32 221097485",
        'HR' => "+49 32 221097485",
        'CY' => "+49 32 221097485",
        'CZ' => "+49 32 221097485",
        'DK' => "+49 32 221097485",
        'EE' => "+49 32 221097485",
        'FI' => "+49 32 221097485",
        'GR' => "+49 32 221097485",
        'HU' => "+49 32 221097485",
        'IE' => "+49 32 221097485",
        'LV' => "+49 32 221097485",
        'LT' => "+49 32 221097485",
        'LU' => "+49 32 221097485",
        'MT' => "+49 32 221097485",
        'PT' => "+49 32 221097485",
        'RO' => "+49 32 221097485",
        'SK' => "+49 32 221097485",
        'SI' => "+49 32 221097485",
        'SE' => "+49 32 221097485",
        'NO' => "+49 32 221097485",
        'RS' => "+49 32 221097485",
        'CH' => "+49 32 221097485",
        'IS' => "+49 32 221097485",
        'JE' => "+49 32 221097485",
        'TR' => "+49 32 221097485"
    ];
}
