<?php
/**
 * SortedServices file
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
namespace UPS\Shipping\Model;

/**
 * SortedServices class
 *
 * @category  UPS_Shipping
 * @package   UPS_Shipping
 * @author    United Parcel Service of America, Inc. <noreply@ups.com>
 * @copyright 2019 United Parcel Service of America, Inc., all rights reserved
 * @license   This work is Licensed under the License and Data Service Terms available
 * at: https://www.ups.com/assets/resources/media/ups-license-and-data-service-terms.pdf
 * @link      https://www.ups.com/pl/en/services/technology-integration/ecommerce-plugins.page
 */
class SortedServices extends \Magento\Framework\Model\AbstractModel
{

    /**
     * SortedServices getListSortedServicesByCountryCode
     *
     * @param $countryCode //Country Code
     * @param $serviceType //Service Type
     *
     * @return array $services
     */
    public function getListSortedServicesByCountryCode($countryCode, $serviceType = null)
    {
        $services = [];

        $services['PL']['AP'][] = 'UPS_SP_SERV_PL_AP_AP_ECONOMY';
        $services['PL']['AP'][] = 'UPS_SP_SERV_PL_AP_STANDARD';
        $services['PL']['AP'][] = 'UPS_SP_SERV_PL_AP_STANDARD_SAT_DELI';
        $services['PL']['AP'][] = 'UPS_SP_SERV_PL_AP_EXPEDITED';
        $services['PL']['AP'][] = 'UPS_SP_SERV_PL_AP_EXPRESS_SAVER';
        $services['PL']['AP'][] = 'UPS_SP_SERV_PL_AP_EXPRESS';
        $services['PL']['AP'][] = 'UPS_SP_SERV_PL_AP_EXPRESS_SAT_DELI';
        $services['PL']['AP'][] = 'UPS_SP_SERV_PL_AP_EXPRESS_PLUS';

        $services['PL']['ADD'][] = 'UPS_SP_SERV_PL_ADD_STANDARD';
        $services['PL']['ADD'][] = 'UPS_SP_SERV_PL_ADD_STANDARD_SAT_DELI';
        $services['PL']['ADD'][] = 'UPS_SP_SERV_PL_ADD_EXPEDITED';
        $services['PL']['ADD'][] = 'UPS_SP_SERV_PL_ADD_EXPRESS_SAVER';
        $services['PL']['ADD'][] = 'UPS_SP_SERV_PL_ADD_EXPRESS';
        $services['PL']['ADD'][] = 'UPS_SP_SERV_PL_ADD_EXPRESS_SAT_DELI';
        $services['PL']['ADD'][] = 'UPS_SP_SERV_PL_ADD_EXPRESS_PLUS';

        $services['GB']['AP'][] = 'UPS_SP_SERV_GB_AP_STANDARD';
        $services['GB']['AP'][] = 'UPS_SP_SERV_GB_AP_STANDARD_SAT_DELI';
        $services['GB']['AP'][] = 'UPS_SP_SERV_GB_AP_EXPEDITED';
        $services['GB']['AP'][] = 'UPS_SP_SERV_GB_AP_WW_SAVER';
        $services['GB']['AP'][] = 'UPS_SP_SERV_GB_AP_EXPRESS';
        $services['GB']['AP'][] = 'UPS_SP_SERV_GB_AP_EXPRESS_SAT_DELI';
        $services['GB']['AP'][] = 'UPS_SP_SERV_GB_AP_WW_EXPRESS_PLUS';

        $services['GB']['ADD'][] = 'UPS_SP_SERV_GB_ADD_STANDARD';
        $services['GB']['ADD'][] = 'UPS_SP_SERV_GB_ADD_STANDARD_SAT_DELI';
        $services['GB']['ADD'][] = 'UPS_SP_SERV_GB_ADD_EXPEDITED';
        $services['GB']['ADD'][] = 'UPS_SP_SERV_GB_ADD_WW_SAVER';
        $services['GB']['ADD'][] = 'UPS_SP_SERV_GB_ADD_EXPRESS';
        $services['GB']['ADD'][] = 'UPS_SP_SERV_GB_ADD_EXPRESS_SAT_DELI';
        $services['GB']['ADD'][] = 'UPS_SP_SERV_GB_ADD_WW_EXPRESS_PLUS';

        $services['FR']['AP'][] = 'UPS_SP_SERV_FR_AP_AP_ECONOMY';
        $services['FR']['AP'][] = 'UPS_SP_SERV_FR_AP_STANDARD';
        $services['FR']['AP'][] = 'UPS_SP_SERV_FR_AP_STANDARD_SAT_DELI';
        $services['FR']['AP'][] = 'UPS_SP_SERV_FR_AP_EXPEDITED';
        $services['FR']['AP'][] = 'UPS_SP_SERV_FR_AP_EXPRESS_SAVER';
        $services['FR']['AP'][] = 'UPS_SP_SERV_FR_AP_EXPRESS';
        $services['FR']['AP'][] = 'UPS_SP_SERV_FR_AP_EXPRESS_SAT_DELI';
        $services['FR']['AP'][] = 'UPS_SP_SERV_FR_AP_EXPRESS_PLUS';

        $services['FR']['ADD'][] = 'UPS_SP_SERV_FR_ADD_STANDARD';
        $services['FR']['ADD'][] = 'UPS_SP_SERV_FR_ADD_STANDARD_SAT_DELI';
        $services['FR']['ADD'][] = 'UPS_SP_SERV_FR_ADD_EXPEDITED';
        $services['FR']['ADD'][] = 'UPS_SP_SERV_FR_ADD_EXPRESS_SAVER';
        $services['FR']['ADD'][] = 'UPS_SP_SERV_FR_ADD_EXPRESS';
        $services['FR']['ADD'][] = 'UPS_SP_SERV_FR_ADD_EXPRESS_SAT_DELI';
        $services['FR']['ADD'][] = 'UPS_SP_SERV_FR_ADD_EXPRESS_PLUS';

        $services['DE']['AP'][] = 'UPS_SP_SERV_DE_AP_STANDARD';
        $services['DE']['AP'][] = 'UPS_SP_SERV_DE_AP_STANDARD_SAT_DELI';
        $services['DE']['AP'][] = 'UPS_SP_SERV_DE_AP_EXPEDITED';
        $services['DE']['AP'][] = 'UPS_SP_SERV_DE_AP_EXPRESS_SAVER';
        $services['DE']['AP'][] = 'UPS_SP_SERV_DE_AP_UPS_EXPRESS12';
        $services['DE']['AP'][] = 'UPS_SP_SERV_DE_AP_EXPRESS';
        $services['DE']['AP'][] = 'UPS_SP_SERV_DE_AP_EXPRESS_SAT_DELI';
        $services['DE']['AP'][] = 'UPS_SP_SERV_DE_AP_EXPRESS_PLUS';

        $services['DE']['ADD'][] = 'UPS_SP_SERV_DE_ADD_STANDARD';
        $services['DE']['ADD'][] = 'UPS_SP_SERV_DE_ADD_STANDARD_SAT_DELI';
        $services['DE']['ADD'][] = 'UPS_SP_SERV_DE_ADD_EXPEDITED';
        $services['DE']['ADD'][] = 'UPS_SP_SERV_DE_ADD_EXPRESS_SAVER';
        $services['DE']['ADD'][] = 'UPS_SP_SERV_DE_ADD_EXPRESS12';
        $services['DE']['ADD'][] = 'UPS_SP_SERV_DE_ADD_EXPRESS';
        $services['DE']['ADD'][] = 'UPS_SP_SERV_DE_ADD_EXPRESS_SAT_DELI';
        $services['DE']['ADD'][] = 'UPS_SP_SERV_DE_ADD_EXPRESS_PLUS';

        $services['ES']['AP'][] = 'UPS_SP_SERV_ES_AP_STANDARD';
        $services['ES']['AP'][] = 'UPS_SP_SERV_ES_AP_STANDARD_SAT_DELI';
        $services['ES']['AP'][] = 'UPS_SP_SERV_ES_AP_EXPEDITED';
        $services['ES']['AP'][] = 'UPS_SP_SERV_ES_AP_EXPRESS_SAVER';
        $services['ES']['AP'][] = 'UPS_SP_SERV_ES_AP_EXPRESS';
        $services['ES']['AP'][] = 'UPS_SP_SERV_ES_AP_EXPRESS_SAT_DELI';
        $services['ES']['AP'][] = 'UPS_SP_SERV_ES_AP_EXPRESS_PLUS';

        $services['ES']['ADD'][] = 'UPS_SP_SERV_ES_ADD_STANDARD';
        $services['ES']['ADD'][] = 'UPS_SP_SERV_ES_ADD_STANDARD_SAT_DELI';
        $services['ES']['ADD'][] = 'UPS_SP_SERV_ES_ADD_EXPEDITED';
        $services['ES']['ADD'][] = 'UPS_SP_SERV_ES_ADD_EXPRESS_SAVER';
        $services['ES']['ADD'][] = 'UPS_SP_SERV_ES_ADD_EXPRESS';
        $services['ES']['ADD'][] = 'UPS_SP_SERV_ES_ADD_EXPRESS_SAT_DELI';
        $services['ES']['ADD'][] = 'UPS_SP_SERV_ES_ADD_EXPRESS_PLUS';

        $services['IT']['AP'][] = 'UPS_SP_SERV_IT_AP_STANDARD';
        $services['IT']['AP'][] = 'UPS_SP_SERV_IT_AP_STANDARD_SAT_DELI';
        $services['IT']['AP'][] = 'UPS_SP_SERV_IT_AP_EXPEDITED';
        $services['IT']['AP'][] = 'UPS_SP_SERV_IT_AP_EXPRESS_SAVER';
        $services['IT']['AP'][] = 'UPS_SP_SERV_IT_AP_EXPRESS';
        $services['IT']['AP'][] = 'UPS_SP_SERV_IT_AP_EXPRESS_SAT_DELI';
        $services['IT']['AP'][] = 'UPS_SP_SERV_IT_AP_EXPRESS_PLUS';

        $services['IT']['ADD'][] = 'UPS_SP_SERV_IT_ADD_STANDARD';
        $services['IT']['ADD'][] = 'UPS_SP_SERV_IT_ADD_STANDARD_SAT_DELI';
        $services['IT']['ADD'][] = 'UPS_SP_SERV_IT_ADD_EXPEDITED';
        $services['IT']['ADD'][] = 'UPS_SP_SERV_IT_ADD_EXPRESS_SAVER';
        $services['IT']['ADD'][] = 'UPS_SP_SERV_IT_ADD_EXPRESS';
        $services['IT']['ADD'][] = 'UPS_SP_SERV_IT_ADD_EXPRESS_SAT_DELI';
        $services['IT']['ADD'][] = 'UPS_SP_SERV_IT_ADD_EXPRESS_PLUS';

        $services['NL']['AP'][] = 'UPS_SP_SERV_NL_AP_AP_ECONOMY';
        $services['NL']['AP'][] = 'UPS_SP_SERV_NL_AP_STANDARD';
        $services['NL']['AP'][] = 'UPS_SP_SERV_NL_AP_STANDARD_SAT_DELI';
        $services['NL']['AP'][] = 'UPS_SP_SERV_NL_AP_EXPEDITED';
        $services['NL']['AP'][] = 'UPS_SP_SERV_NL_AP_EXPRESS_SAVER';
        $services['NL']['AP'][] = 'UPS_SP_SERV_NL_AP_EXPRESS';
        $services['NL']['AP'][] = 'UPS_SP_SERV_NL_AP_EXPRESS_SAT_DELI';
        $services['NL']['AP'][] = 'UPS_SP_SERV_NL_AP_EXPRESS_PLUS';

        $services['NL']['ADD'][] = 'UPS_SP_SERV_NL_ADD_STANDARD';
        $services['NL']['ADD'][] = 'UPS_SP_SERV_NL_ADD_STANDARD_SAT_DELI';
        $services['NL']['ADD'][] = 'UPS_SP_SERV_NL_ADD_EXPEDITED';
        $services['NL']['ADD'][] = 'UPS_SP_SERV_NL_ADD_EXPRESS_SAVER';
        $services['NL']['ADD'][] = 'UPS_SP_SERV_NL_ADD_EXPRESS';
        $services['NL']['ADD'][] = 'UPS_SP_SERV_NL_ADD_EXPRESS_SAT_DELI';
        $services['NL']['ADD'][] = 'UPS_SP_SERV_NL_ADD_EXPRESS_PLUS';

        $services['BE']['AP'][] = 'UPS_SP_SERV_BE_AP_AP_ECONOMY';
        $services['BE']['AP'][] = 'UPS_SP_SERV_BE_AP_STANDARD';
        $services['BE']['AP'][] = 'UPS_SP_SERV_BE_AP_STANDARD_SAT_DELI';
        $services['BE']['AP'][] = 'UPS_SP_SERV_BE_AP_EXPEDITED';
        $services['BE']['AP'][] = 'UPS_SP_SERV_BE_AP_EXPRESS_SAVER';
        $services['BE']['AP'][] = 'UPS_SP_SERV_BE_AP_EXPRESS';
        $services['BE']['AP'][] = 'UPS_SP_SERV_BE_AP_EXPRESS_SAT_DELI';
        $services['BE']['AP'][] = 'UPS_SP_SERV_BE_AP_EXPRESS_PLUS';

        $services['BE']['ADD'][] = 'UPS_SP_SERV_BE_ADD_STANDARD';
        $services['BE']['ADD'][] = 'UPS_SP_SERV_BE_ADD_STANDARD_SAT_DELI';
        $services['BE']['ADD'][] = 'UPS_SP_SERV_BE_ADD_EXPEDITED';
        $services['BE']['ADD'][] = 'UPS_SP_SERV_BE_ADD_EXPRESS_SAVER';
        $services['BE']['ADD'][] = 'UPS_SP_SERV_BE_ADD_EXPRESS';
        $services['BE']['ADD'][] = 'UPS_SP_SERV_BE_ADD_EXPRESS_SAT_DELI';
        $services['BE']['ADD'][] = 'UPS_SP_SERV_BE_ADD_EXPRESS_PLUS';

        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_GROUND';
        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_3_DAY_SELECT';
        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_DAY_AIR';
        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_DAY_AIR_AM';
        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_AIR_SAVER';
        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_AIR';
        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_AIR_EARLY';
        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_STANDARD';
        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_WORLDWIDE_EXPEDITED';
        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_WORLDWIDE_SAVER';
        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_WORLDWIDE_EXPRESS';
        $services['US']['AP'][] = 'UPS_SP_SERV_US_AP_WORLDWIDE_EXPRESS_PLUS';

        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_GROUND';
        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_3_DAY_SELECT';
        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_DAY_AIR';
        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_DAY_AIR_AM';
        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_AIR_SAVER';
        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_AIR';
        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_AIR_EARLY';
        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_STANDARD';
        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_WORLDWIDE_EXPEDITED';
        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_WORLDWIDE_SAVER';
        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_WORLDWIDE_EXPRESS';
        $services['US']['ADD'][] = 'UPS_SP_SERV_US_ADD_WORLDWIDE_EXPRESS_PLUS';

        $services['AT']['AP'][] = 'UPS_SP_SERV_AT_AP_STANDARD';
        $services['AT']['AP'][] = 'UPS_SP_SERV_AT_AP_STANDARD_SAT_DELI';
        $services['AT']['AP'][] = 'UPS_SP_SERV_AT_AP_EXPEDITED';
        $services['AT']['AP'][] = 'UPS_SP_SERV_AT_AP_EXPRESS_SAVER';
        $services['AT']['AP'][] = 'UPS_SP_SERV_AT_AP_UPS_EXPRESS12';
        $services['AT']['AP'][] = 'UPS_SP_SERV_AT_AP_EXPRESS';
        $services['AT']['AP'][] = 'UPS_SP_SERV_AT_AP_EXPRESS_SAT_DELI';
        $services['AT']['AP'][] = 'UPS_SP_SERV_AT_AP_EXPRESS_PLUS';

        $services['AT']['ADD'][] = 'UPS_SP_SERV_AT_ADD_STANDARD';
        $services['AT']['ADD'][] = 'UPS_SP_SERV_AT_ADD_STANDARD_SAT_DELI';
        $services['AT']['ADD'][] = 'UPS_SP_SERV_AT_ADD_EXPEDITED';
        $services['AT']['ADD'][] = 'UPS_SP_SERV_AT_ADD_EXPRESS_SAVER';
        $services['AT']['ADD'][] = 'UPS_SP_SERV_AT_ADD_EXPRESS12';
        $services['AT']['ADD'][] = 'UPS_SP_SERV_AT_ADD_EXPRESS';
        $services['AT']['ADD'][] = 'UPS_SP_SERV_AT_ADD_EXPRESS_SAT_DELI';
        $services['AT']['ADD'][] = 'UPS_SP_SERV_AT_ADD_EXPRESS_PLUS';

        $services['BG']['AP'][] = 'UPS_SP_SERV_BG_AP_STANDARD';
        $services['BG']['AP'][] = 'UPS_SP_SERV_BG_AP_STANDARD_SAT_DELI';
        $services['BG']['AP'][] = 'UPS_SP_SERV_BG_AP_EXPEDITED';
        $services['BG']['AP'][] = 'UPS_SP_SERV_BG_AP_EXPRESS_SAVER';
        $services['BG']['AP'][] = 'UPS_SP_SERV_BG_AP_UPS_EXPRESS12';
        $services['BG']['AP'][] = 'UPS_SP_SERV_BG_AP_EXPRESS';
        $services['BG']['AP'][] = 'UPS_SP_SERV_BG_AP_EXPRESS_SAT_DELI';
        $services['BG']['AP'][] = 'UPS_SP_SERV_BG_AP_EXPRESS_PLUS';

        $services['BG']['ADD'][] = 'UPS_SP_SERV_BG_ADD_STANDARD';
        $services['BG']['ADD'][] = 'UPS_SP_SERV_BG_ADD_STANDARD_SAT_DELI';
        $services['BG']['ADD'][] = 'UPS_SP_SERV_BG_ADD_EXPEDITED';
        $services['BG']['ADD'][] = 'UPS_SP_SERV_BG_ADD_EXPRESS_SAVER';
        $services['BG']['ADD'][] = 'UPS_SP_SERV_BG_ADD_EXPRESS12';
        $services['BG']['ADD'][] = 'UPS_SP_SERV_BG_ADD_EXPRESS';
        $services['BG']['ADD'][] = 'UPS_SP_SERV_BG_ADD_EXPRESS_SAT_DELI';
        $services['BG']['ADD'][] = 'UPS_SP_SERV_BG_ADD_EXPRESS_PLUS';

        $services['HR']['AP'][] = 'UPS_SP_SERV_HR_AP_STANDARD';
        $services['HR']['AP'][] = 'UPS_SP_SERV_HR_AP_STANDARD_SAT_DELI';
        $services['HR']['AP'][] = 'UPS_SP_SERV_HR_AP_EXPEDITED';
        $services['HR']['AP'][] = 'UPS_SP_SERV_HR_AP_EXPRESS_SAVER';
        $services['HR']['AP'][] = 'UPS_SP_SERV_HR_AP_UPS_EXPRESS12';
        $services['HR']['AP'][] = 'UPS_SP_SERV_HR_AP_EXPRESS';
        $services['HR']['AP'][] = 'UPS_SP_SERV_HR_AP_EXPRESS_SAT_DELI';
        $services['HR']['AP'][] = 'UPS_SP_SERV_HR_AP_EXPRESS_PLUS';

        $services['HR']['ADD'][] = 'UPS_SP_SERV_HR_ADD_STANDARD';
        $services['HR']['ADD'][] = 'UPS_SP_SERV_HR_ADD_STANDARD_SAT_DELI';
        $services['HR']['ADD'][] = 'UPS_SP_SERV_HR_ADD_EXPEDITED';
        $services['HR']['ADD'][] = 'UPS_SP_SERV_HR_ADD_EXPRESS_SAVER';
        $services['HR']['ADD'][] = 'UPS_SP_SERV_HR_ADD_EXPRESS12';
        $services['HR']['ADD'][] = 'UPS_SP_SERV_HR_ADD_EXPRESS';
        $services['HR']['ADD'][] = 'UPS_SP_SERV_HR_ADD_EXPRESS_SAT_DELI';
        $services['HR']['ADD'][] = 'UPS_SP_SERV_HR_ADD_EXPRESS_PLUS';

        $services['CY']['AP'][] = 'UPS_SP_SERV_CY_AP_STANDARD';
        $services['CY']['AP'][] = 'UPS_SP_SERV_CY_AP_STANDARD_SAT_DELI';
        $services['CY']['AP'][] = 'UPS_SP_SERV_CY_AP_EXPEDITED';
        $services['CY']['AP'][] = 'UPS_SP_SERV_CY_AP_EXPRESS_SAVER';
        $services['CY']['AP'][] = 'UPS_SP_SERV_CY_AP_UPS_EXPRESS12';
        $services['CY']['AP'][] = 'UPS_SP_SERV_CY_AP_EXPRESS';
        $services['CY']['AP'][] = 'UPS_SP_SERV_CY_AP_EXPRESS_SAT_DELI';
        $services['CY']['AP'][] = 'UPS_SP_SERV_CY_AP_EXPRESS_PLUS';

        $services['CY']['ADD'][] = 'UPS_SP_SERV_CY_ADD_STANDARD';
        $services['CY']['ADD'][] = 'UPS_SP_SERV_CY_ADD_STANDARD_SAT_DELI';
        $services['CY']['ADD'][] = 'UPS_SP_SERV_CY_ADD_EXPEDITED';
        $services['CY']['ADD'][] = 'UPS_SP_SERV_CY_ADD_EXPRESS_SAVER';
        $services['CY']['ADD'][] = 'UPS_SP_SERV_CY_ADD_EXPRESS12';
        $services['CY']['ADD'][] = 'UPS_SP_SERV_CY_ADD_EXPRESS';
        $services['CY']['ADD'][] = 'UPS_SP_SERV_CY_ADD_EXPRESS_SAT_DELI';
        $services['CY']['ADD'][] = 'UPS_SP_SERV_CY_ADD_EXPRESS_PLUS';

        $services['CZ']['AP'][] = 'UPS_SP_SERV_CZ_AP_STANDARD';
        $services['CZ']['AP'][] = 'UPS_SP_SERV_CZ_AP_STANDARD_SAT_DELI';
        $services['CZ']['AP'][] = 'UPS_SP_SERV_CZ_AP_EXPEDITED';
        $services['CZ']['AP'][] = 'UPS_SP_SERV_CZ_AP_EXPRESS_SAVER';
        $services['CZ']['AP'][] = 'UPS_SP_SERV_CZ_AP_UPS_EXPRESS12';
        $services['CZ']['AP'][] = 'UPS_SP_SERV_CZ_AP_EXPRESS';
        $services['CZ']['AP'][] = 'UPS_SP_SERV_CZ_AP_EXPRESS_SAT_DELI';
        $services['CZ']['AP'][] = 'UPS_SP_SERV_CZ_AP_EXPRESS_PLUS';

        $services['CZ']['ADD'][] = 'UPS_SP_SERV_CZ_ADD_STANDARD';
        $services['CZ']['ADD'][] = 'UPS_SP_SERV_CZ_ADD_STANDARD_SAT_DELI';
        $services['CZ']['ADD'][] = 'UPS_SP_SERV_CZ_ADD_EXPEDITED';
        $services['CZ']['ADD'][] = 'UPS_SP_SERV_CZ_ADD_EXPRESS_SAVER';
        $services['CZ']['ADD'][] = 'UPS_SP_SERV_CZ_ADD_EXPRESS12';
        $services['CZ']['ADD'][] = 'UPS_SP_SERV_CZ_ADD_EXPRESS';
        $services['CZ']['ADD'][] = 'UPS_SP_SERV_CZ_ADD_EXPRESS_SAT_DELI';
        $services['CZ']['ADD'][] = 'UPS_SP_SERV_CZ_ADD_EXPRESS_PLUS';

        $services['DK']['AP'][] = 'UPS_SP_SERV_DK_AP_STANDARD';
        $services['DK']['AP'][] = 'UPS_SP_SERV_DK_AP_STANDARD_SAT_DELI';
        $services['DK']['AP'][] = 'UPS_SP_SERV_DK_AP_EXPEDITED';
        $services['DK']['AP'][] = 'UPS_SP_SERV_DK_AP_EXPRESS_SAVER';
        $services['DK']['AP'][] = 'UPS_SP_SERV_DK_AP_UPS_EXPRESS12';
        $services['DK']['AP'][] = 'UPS_SP_SERV_DK_AP_EXPRESS';
        $services['DK']['AP'][] = 'UPS_SP_SERV_DK_AP_EXPRESS_SAT_DELI';
        $services['DK']['AP'][] = 'UPS_SP_SERV_DK_AP_EXPRESS_PLUS';

        $services['DK']['ADD'][] = 'UPS_SP_SERV_DK_ADD_STANDARD';
        $services['DK']['ADD'][] = 'UPS_SP_SERV_DK_ADD_STANDARD_SAT_DELI';
        $services['DK']['ADD'][] = 'UPS_SP_SERV_DK_ADD_EXPEDITED';
        $services['DK']['ADD'][] = 'UPS_SP_SERV_DK_ADD_EXPRESS_SAVER';
        $services['DK']['ADD'][] = 'UPS_SP_SERV_DK_ADD_EXPRESS12';
        $services['DK']['ADD'][] = 'UPS_SP_SERV_DK_ADD_EXPRESS';
        $services['DK']['ADD'][] = 'UPS_SP_SERV_DK_ADD_EXPRESS_SAT_DELI';
        $services['DK']['ADD'][] = 'UPS_SP_SERV_DK_ADD_EXPRESS_PLUS';

        $services['EE']['AP'][] = 'UPS_SP_SERV_EE_AP_STANDARD';
        $services['EE']['AP'][] = 'UPS_SP_SERV_EE_AP_STANDARD_SAT_DELI';
        $services['EE']['AP'][] = 'UPS_SP_SERV_EE_AP_EXPEDITED';
        $services['EE']['AP'][] = 'UPS_SP_SERV_EE_AP_EXPRESS_SAVER';
        $services['EE']['AP'][] = 'UPS_SP_SERV_EE_AP_UPS_EXPRESS12';
        $services['EE']['AP'][] = 'UPS_SP_SERV_EE_AP_EXPRESS';
        $services['EE']['AP'][] = 'UPS_SP_SERV_EE_AP_EXPRESS_SAT_DELI';
        $services['EE']['AP'][] = 'UPS_SP_SERV_EE_AP_EXPRESS_PLUS';

        $services['EE']['ADD'][] = 'UPS_SP_SERV_EE_ADD_STANDARD';
        $services['EE']['ADD'][] = 'UPS_SP_SERV_EE_ADD_STANDARD_SAT_DELI';
        $services['EE']['ADD'][] = 'UPS_SP_SERV_EE_ADD_EXPEDITED';
        $services['EE']['ADD'][] = 'UPS_SP_SERV_EE_ADD_EXPRESS_SAVER';
        $services['EE']['ADD'][] = 'UPS_SP_SERV_EE_ADD_EXPRESS12';
        $services['EE']['ADD'][] = 'UPS_SP_SERV_EE_ADD_EXPRESS';
        $services['EE']['ADD'][] = 'UPS_SP_SERV_EE_ADD_EXPRESS_SAT_DELI';
        $services['EE']['ADD'][] = 'UPS_SP_SERV_EE_ADD_EXPRESS_PLUS';

        $services['FI']['AP'][] = 'UPS_SP_SERV_FI_AP_STANDARD';
        $services['FI']['AP'][] = 'UPS_SP_SERV_FI_AP_STANDARD_SAT_DELI';
        $services['FI']['AP'][] = 'UPS_SP_SERV_FI_AP_EXPEDITED';
        $services['FI']['AP'][] = 'UPS_SP_SERV_FI_AP_EXPRESS_SAVER';
        $services['FI']['AP'][] = 'UPS_SP_SERV_FI_AP_UPS_EXPRESS12';
        $services['FI']['AP'][] = 'UPS_SP_SERV_FI_AP_EXPRESS';
        $services['FI']['AP'][] = 'UPS_SP_SERV_FI_AP_EXPRESS_SAT_DELI';
        $services['FI']['AP'][] = 'UPS_SP_SERV_FI_AP_EXPRESS_PLUS';

        $services['FI']['ADD'][] = 'UPS_SP_SERV_FI_ADD_STANDARD';
        $services['FI']['ADD'][] = 'UPS_SP_SERV_FI_ADD_STANDARD_SAT_DELI';
        $services['FI']['ADD'][] = 'UPS_SP_SERV_FI_ADD_EXPEDITED';
        $services['FI']['ADD'][] = 'UPS_SP_SERV_FI_ADD_EXPRESS_SAVER';
        $services['FI']['ADD'][] = 'UPS_SP_SERV_FI_ADD_EXPRESS12';
        $services['FI']['ADD'][] = 'UPS_SP_SERV_FI_ADD_EXPRESS';
        $services['FI']['ADD'][] = 'UPS_SP_SERV_FI_ADD_EXPRESS_SAT_DELI';
        $services['FI']['ADD'][] = 'UPS_SP_SERV_FI_ADD_EXPRESS_PLUS';

        $services['GR']['AP'][] = 'UPS_SP_SERV_GR_AP_STANDARD';
        $services['GR']['AP'][] = 'UPS_SP_SERV_GR_AP_STANDARD_SAT_DELI';
        $services['GR']['AP'][] = 'UPS_SP_SERV_GR_AP_EXPEDITED';
        $services['GR']['AP'][] = 'UPS_SP_SERV_GR_AP_EXPRESS_SAVER';
        $services['GR']['AP'][] = 'UPS_SP_SERV_GR_AP_UPS_EXPRESS12';
        $services['GR']['AP'][] = 'UPS_SP_SERV_GR_AP_EXPRESS';
        $services['GR']['AP'][] = 'UPS_SP_SERV_GR_AP_EXPRESS_SAT_DELI';
        $services['GR']['AP'][] = 'UPS_SP_SERV_GR_AP_EXPRESS_PLUS';

        $services['GR']['ADD'][] = 'UPS_SP_SERV_GR_ADD_STANDARD';
        $services['GR']['ADD'][] = 'UPS_SP_SERV_GR_ADD_STANDARD_SAT_DELI';
        $services['GR']['ADD'][] = 'UPS_SP_SERV_GR_ADD_EXPEDITED';
        $services['GR']['ADD'][] = 'UPS_SP_SERV_GR_ADD_EXPRESS_SAVER';
        $services['GR']['ADD'][] = 'UPS_SP_SERV_GR_ADD_EXPRESS12';
        $services['GR']['ADD'][] = 'UPS_SP_SERV_GR_ADD_EXPRESS';
        $services['GR']['ADD'][] = 'UPS_SP_SERV_GR_ADD_EXPRESS_SAT_DELI';
        $services['GR']['ADD'][] = 'UPS_SP_SERV_GR_ADD_EXPRESS_PLUS';

        $services['HU']['AP'][] = 'UPS_SP_SERV_HU_AP_STANDARD';
        $services['HU']['AP'][] = 'UPS_SP_SERV_HU_AP_STANDARD_SAT_DELI';
        $services['HU']['AP'][] = 'UPS_SP_SERV_HU_AP_EXPEDITED';
        $services['HU']['AP'][] = 'UPS_SP_SERV_HU_AP_EXPRESS_SAVER';
        $services['HU']['AP'][] = 'UPS_SP_SERV_HU_AP_UPS_EXPRESS12';
        $services['HU']['AP'][] = 'UPS_SP_SERV_HU_AP_EXPRESS';
        $services['HU']['AP'][] = 'UPS_SP_SERV_HU_AP_EXPRESS_SAT_DELI';
        $services['HU']['AP'][] = 'UPS_SP_SERV_HU_AP_EXPRESS_PLUS';

        $services['HU']['ADD'][] = 'UPS_SP_SERV_HU_ADD_STANDARD';
        $services['HU']['ADD'][] = 'UPS_SP_SERV_HU_ADD_STANDARD_SAT_DELI';
        $services['HU']['ADD'][] = 'UPS_SP_SERV_HU_ADD_EXPEDITED';
        $services['HU']['ADD'][] = 'UPS_SP_SERV_HU_ADD_EXPRESS_SAVER';
        $services['HU']['ADD'][] = 'UPS_SP_SERV_HU_ADD_EXPRESS12';
        $services['HU']['ADD'][] = 'UPS_SP_SERV_HU_ADD_EXPRESS';
        $services['HU']['ADD'][] = 'UPS_SP_SERV_HU_ADD_EXPRESS_SAT_DELI';
        $services['HU']['ADD'][] = 'UPS_SP_SERV_HU_ADD_EXPRESS_PLUS';

        $services['IE']['AP'][] = 'UPS_SP_SERV_IE_AP_STANDARD';
        $services['IE']['AP'][] = 'UPS_SP_SERV_IE_AP_STANDARD_SAT_DELI';
        $services['IE']['AP'][] = 'UPS_SP_SERV_IE_AP_EXPEDITED';
        $services['IE']['AP'][] = 'UPS_SP_SERV_IE_AP_EXPRESS_SAVER';
        $services['IE']['AP'][] = 'UPS_SP_SERV_IE_AP_UPS_EXPRESS12';
        $services['IE']['AP'][] = 'UPS_SP_SERV_IE_AP_EXPRESS';
        $services['IE']['AP'][] = 'UPS_SP_SERV_IE_AP_EXPRESS_SAT_DELI';
        $services['IE']['AP'][] = 'UPS_SP_SERV_IE_AP_EXPRESS_PLUS';

        $services['IE']['ADD'][] = 'UPS_SP_SERV_IE_ADD_STANDARD';
        $services['IE']['ADD'][] = 'UPS_SP_SERV_IE_ADD_STANDARD_SAT_DELI';
        $services['IE']['ADD'][] = 'UPS_SP_SERV_IE_ADD_EXPEDITED';
        $services['IE']['ADD'][] = 'UPS_SP_SERV_IE_ADD_EXPRESS_SAVER';
        $services['IE']['ADD'][] = 'UPS_SP_SERV_IE_ADD_EXPRESS12';
        $services['IE']['ADD'][] = 'UPS_SP_SERV_IE_ADD_EXPRESS';
        $services['IE']['ADD'][] = 'UPS_SP_SERV_IE_ADD_EXPRESS_SAT_DELI';
        $services['IE']['ADD'][] = 'UPS_SP_SERV_IE_ADD_EXPRESS_PLUS';

        $services['LV']['AP'][] = 'UPS_SP_SERV_LV_AP_STANDARD';
        $services['LV']['AP'][] = 'UPS_SP_SERV_LV_AP_STANDARD_SAT_DELI';
        $services['LV']['AP'][] = 'UPS_SP_SERV_LV_AP_EXPEDITED';
        $services['LV']['AP'][] = 'UPS_SP_SERV_LV_AP_EXPRESS_SAVER';
        $services['LV']['AP'][] = 'UPS_SP_SERV_LV_AP_UPS_EXPRESS12';
        $services['LV']['AP'][] = 'UPS_SP_SERV_LV_AP_EXPRESS';
        $services['LV']['AP'][] = 'UPS_SP_SERV_LV_AP_EXPRESS_SAT_DELI';
        $services['LV']['AP'][] = 'UPS_SP_SERV_LV_AP_EXPRESS_PLUS';

        $services['LV']['ADD'][] = 'UPS_SP_SERV_LV_ADD_STANDARD';
        $services['LV']['ADD'][] = 'UPS_SP_SERV_LV_ADD_STANDARD_SAT_DELI';
        $services['LV']['ADD'][] = 'UPS_SP_SERV_LV_ADD_EXPEDITED';
        $services['LV']['ADD'][] = 'UPS_SP_SERV_LV_ADD_EXPRESS_SAVER';
        $services['LV']['ADD'][] = 'UPS_SP_SERV_LV_ADD_EXPRESS12';
        $services['LV']['ADD'][] = 'UPS_SP_SERV_LV_ADD_EXPRESS';
        $services['LV']['ADD'][] = 'UPS_SP_SERV_LV_ADD_EXPRESS_SAT_DELI';
        $services['LV']['ADD'][] = 'UPS_SP_SERV_LV_ADD_EXPRESS_PLUS';

        $services['LT']['AP'][] = 'UPS_SP_SERV_LT_AP_STANDARD';
        $services['LT']['AP'][] = 'UPS_SP_SERV_LT_AP_STANDARD_SAT_DELI';
        $services['LT']['AP'][] = 'UPS_SP_SERV_LT_AP_EXPEDITED';
        $services['LT']['AP'][] = 'UPS_SP_SERV_LT_AP_EXPRESS_SAVER';
        $services['LT']['AP'][] = 'UPS_SP_SERV_LT_AP_UPS_EXPRESS12';
        $services['LT']['AP'][] = 'UPS_SP_SERV_LT_AP_EXPRESS';
        $services['LT']['AP'][] = 'UPS_SP_SERV_LT_AP_EXPRESS_SAT_DELI';
        $services['LT']['AP'][] = 'UPS_SP_SERV_LT_AP_EXPRESS_PLUS';

        $services['LT']['ADD'][] = 'UPS_SP_SERV_LT_ADD_STANDARD';
        $services['LT']['ADD'][] = 'UPS_SP_SERV_LT_ADD_STANDARD_SAT_DELI';
        $services['LT']['ADD'][] = 'UPS_SP_SERV_LT_ADD_EXPEDITED';
        $services['LT']['ADD'][] = 'UPS_SP_SERV_LT_ADD_EXPRESS_SAVER';
        $services['LT']['ADD'][] = 'UPS_SP_SERV_LT_ADD_EXPRESS12';
        $services['LT']['ADD'][] = 'UPS_SP_SERV_LT_ADD_EXPRESS';
        $services['LT']['ADD'][] = 'UPS_SP_SERV_LT_ADD_EXPRESS_SAT_DELI';
        $services['LT']['ADD'][] = 'UPS_SP_SERV_LT_ADD_EXPRESS_PLUS';

        $services['LU']['AP'][] = 'UPS_SP_SERV_LU_AP_STANDARD';
        $services['LU']['AP'][] = 'UPS_SP_SERV_LU_AP_STANDARD_SAT_DELI';
        $services['LU']['AP'][] = 'UPS_SP_SERV_LU_AP_EXPEDITED';
        $services['LU']['AP'][] = 'UPS_SP_SERV_LU_AP_EXPRESS_SAVER';
        $services['LU']['AP'][] = 'UPS_SP_SERV_LU_AP_UPS_EXPRESS12';
        $services['LU']['AP'][] = 'UPS_SP_SERV_LU_AP_EXPRESS';
        $services['LU']['AP'][] = 'UPS_SP_SERV_LU_AP_EXPRESS_SAT_DELI';
        $services['LU']['AP'][] = 'UPS_SP_SERV_LU_AP_EXPRESS_PLUS';

        $services['LU']['ADD'][] = 'UPS_SP_SERV_LU_ADD_STANDARD';
        $services['LU']['ADD'][] = 'UPS_SP_SERV_LU_ADD_STANDARD_SAT_DELI';
        $services['LU']['ADD'][] = 'UPS_SP_SERV_LU_ADD_EXPEDITED';
        $services['LU']['ADD'][] = 'UPS_SP_SERV_LU_ADD_EXPRESS_SAVER';
        $services['LU']['ADD'][] = 'UPS_SP_SERV_LU_ADD_EXPRESS12';
        $services['LU']['ADD'][] = 'UPS_SP_SERV_LU_ADD_EXPRESS';
        $services['LU']['ADD'][] = 'UPS_SP_SERV_LU_ADD_EXPRESS_SAT_DELI';
        $services['LU']['ADD'][] = 'UPS_SP_SERV_LU_ADD_EXPRESS_PLUS';

        $services['MT']['AP'][] = 'UPS_SP_SERV_MT_AP_STANDARD';
        $services['MT']['AP'][] = 'UPS_SP_SERV_MT_AP_STANDARD_SAT_DELI';
        $services['MT']['AP'][] = 'UPS_SP_SERV_MT_AP_EXPEDITED';
        $services['MT']['AP'][] = 'UPS_SP_SERV_MT_AP_EXPRESS_SAVER';
        $services['MT']['AP'][] = 'UPS_SP_SERV_MT_AP_UPS_EXPRESS12';
        $services['MT']['AP'][] = 'UPS_SP_SERV_MT_AP_EXPRESS';
        $services['MT']['AP'][] = 'UPS_SP_SERV_MT_AP_EXPRESS_SAT_DELI';
        $services['MT']['AP'][] = 'UPS_SP_SERV_MT_AP_EXPRESS_PLUS';

        $services['MT']['ADD'][] = 'UPS_SP_SERV_MT_ADD_STANDARD';
        $services['MT']['ADD'][] = 'UPS_SP_SERV_MT_ADD_STANDARD_SAT_DELI';
        $services['MT']['ADD'][] = 'UPS_SP_SERV_MT_ADD_EXPEDITED';
        $services['MT']['ADD'][] = 'UPS_SP_SERV_MT_ADD_EXPRESS_SAVER';
        $services['MT']['ADD'][] = 'UPS_SP_SERV_MT_ADD_EXPRESS12';
        $services['MT']['ADD'][] = 'UPS_SP_SERV_MT_ADD_EXPRESS';
        $services['MT']['ADD'][] = 'UPS_SP_SERV_MT_ADD_EXPRESS_SAT_DELI';
        $services['MT']['ADD'][] = 'UPS_SP_SERV_MT_ADD_EXPRESS_PLUS';

        $services['PT']['AP'][] = 'UPS_SP_SERV_PT_AP_STANDARD';
        $services['PT']['AP'][] = 'UPS_SP_SERV_PT_AP_STANDARD_SAT_DELI';
        $services['PT']['AP'][] = 'UPS_SP_SERV_PT_AP_EXPEDITED';
        $services['PT']['AP'][] = 'UPS_SP_SERV_PT_AP_EXPRESS_SAVER';
        $services['PT']['AP'][] = 'UPS_SP_SERV_PT_AP_UPS_EXPRESS12';
        $services['PT']['AP'][] = 'UPS_SP_SERV_PT_AP_EXPRESS';
        $services['PT']['AP'][] = 'UPS_SP_SERV_PT_AP_EXPRESS_SAT_DELI';
        $services['PT']['AP'][] = 'UPS_SP_SERV_PT_AP_EXPRESS_PLUS';

        $services['PT']['ADD'][] = 'UPS_SP_SERV_PT_ADD_STANDARD';
        $services['PT']['ADD'][] = 'UPS_SP_SERV_PT_ADD_STANDARD_SAT_DELI';
        $services['PT']['ADD'][] = 'UPS_SP_SERV_PT_ADD_EXPEDITED';
        $services['PT']['ADD'][] = 'UPS_SP_SERV_PT_ADD_EXPRESS_SAVER';
        $services['PT']['ADD'][] = 'UPS_SP_SERV_PT_ADD_EXPRESS12';
        $services['PT']['ADD'][] = 'UPS_SP_SERV_PT_ADD_EXPRESS';
        $services['PT']['ADD'][] = 'UPS_SP_SERV_PT_ADD_EXPRESS_SAT_DELI';
        $services['PT']['ADD'][] = 'UPS_SP_SERV_PT_ADD_EXPRESS_PLUS';

        $services['RO']['AP'][] = 'UPS_SP_SERV_RO_AP_STANDARD';
        $services['RO']['AP'][] = 'UPS_SP_SERV_RO_AP_STANDARD_SAT_DELI';
        $services['RO']['AP'][] = 'UPS_SP_SERV_RO_AP_EXPEDITED';
        $services['RO']['AP'][] = 'UPS_SP_SERV_RO_AP_EXPRESS_SAVER';
        $services['RO']['AP'][] = 'UPS_SP_SERV_RO_AP_UPS_EXPRESS12';
        $services['RO']['AP'][] = 'UPS_SP_SERV_RO_AP_EXPRESS';
        $services['RO']['AP'][] = 'UPS_SP_SERV_RO_AP_EXPRESS_SAT_DELI';
        $services['RO']['AP'][] = 'UPS_SP_SERV_RO_AP_EXPRESS_PLUS';

        $services['RO']['ADD'][] = 'UPS_SP_SERV_RO_ADD_STANDARD';
        $services['RO']['ADD'][] = 'UPS_SP_SERV_RO_ADD_STANDARD_SAT_DELI';
        $services['RO']['ADD'][] = 'UPS_SP_SERV_RO_ADD_EXPEDITED';
        $services['RO']['ADD'][] = 'UPS_SP_SERV_RO_ADD_EXPRESS_SAVER';
        $services['RO']['ADD'][] = 'UPS_SP_SERV_RO_ADD_EXPRESS12';
        $services['RO']['ADD'][] = 'UPS_SP_SERV_RO_ADD_EXPRESS';
        $services['RO']['ADD'][] = 'UPS_SP_SERV_RO_ADD_EXPRESS_SAT_DELI';
        $services['RO']['ADD'][] = 'UPS_SP_SERV_RO_ADD_EXPRESS_PLUS';

        $services['SK']['AP'][] = 'UPS_SP_SERV_SK_AP_STANDARD';
        $services['SK']['AP'][] = 'UPS_SP_SERV_SK_AP_STANDARD_SAT_DELI';
        $services['SK']['AP'][] = 'UPS_SP_SERV_SK_AP_EXPEDITED';
        $services['SK']['AP'][] = 'UPS_SP_SERV_SK_AP_EXPRESS_SAVER';
        $services['SK']['AP'][] = 'UPS_SP_SERV_SK_AP_UPS_EXPRESS12';
        $services['SK']['AP'][] = 'UPS_SP_SERV_SK_AP_EXPRESS';
        $services['SK']['AP'][] = 'UPS_SP_SERV_SK_AP_EXPRESS_SAT_DELI';
        $services['SK']['AP'][] = 'UPS_SP_SERV_SK_AP_EXPRESS_PLUS';

        $services['SK']['ADD'][] = 'UPS_SP_SERV_SK_ADD_STANDARD';
        $services['SK']['ADD'][] = 'UPS_SP_SERV_SK_ADD_STANDARD_SAT_DELI';
        $services['SK']['ADD'][] = 'UPS_SP_SERV_SK_ADD_EXPEDITED';
        $services['SK']['ADD'][] = 'UPS_SP_SERV_SK_ADD_EXPRESS_SAVER';
        $services['SK']['ADD'][] = 'UPS_SP_SERV_SK_ADD_EXPRESS12';
        $services['SK']['ADD'][] = 'UPS_SP_SERV_SK_ADD_EXPRESS';
        $services['SK']['ADD'][] = 'UPS_SP_SERV_SK_ADD_EXPRESS_SAT_DELI';
        $services['SK']['ADD'][] = 'UPS_SP_SERV_SK_ADD_EXPRESS_PLUS';

        $services['SI']['AP'][] = 'UPS_SP_SERV_SI_AP_STANDARD';
        $services['SI']['AP'][] = 'UPS_SP_SERV_SI_AP_STANDARD_SAT_DELI';
        $services['SI']['AP'][] = 'UPS_SP_SERV_SI_AP_EXPEDITED';
        $services['SI']['AP'][] = 'UPS_SP_SERV_SI_AP_EXPRESS_SAVER';
        $services['SI']['AP'][] = 'UPS_SP_SERV_SI_AP_UPS_EXPRESS12';
        $services['SI']['AP'][] = 'UPS_SP_SERV_SI_AP_EXPRESS';
        $services['SI']['AP'][] = 'UPS_SP_SERV_SI_AP_EXPRESS_SAT_DELI';
        $services['SI']['AP'][] = 'UPS_SP_SERV_SI_AP_EXPRESS_PLUS';

        $services['SI']['ADD'][] = 'UPS_SP_SERV_SI_ADD_STANDARD';
        $services['SI']['ADD'][] = 'UPS_SP_SERV_SI_ADD_STANDARD_SAT_DELI';
        $services['SI']['ADD'][] = 'UPS_SP_SERV_SI_ADD_EXPEDITED';
        $services['SI']['ADD'][] = 'UPS_SP_SERV_SI_ADD_EXPRESS_SAVER';
        $services['SI']['ADD'][] = 'UPS_SP_SERV_SI_ADD_EXPRESS12';
        $services['SI']['ADD'][] = 'UPS_SP_SERV_SI_ADD_EXPRESS';
        $services['SI']['ADD'][] = 'UPS_SP_SERV_SI_ADD_EXPRESS_SAT_DELI';
        $services['SI']['ADD'][] = 'UPS_SP_SERV_SI_ADD_EXPRESS_PLUS';

        $services['SE']['AP'][] = 'UPS_SP_SERV_SE_AP_STANDARD';
        $services['SE']['AP'][] = 'UPS_SP_SERV_SE_AP_STANDARD_SAT_DELI';
        $services['SE']['AP'][] = 'UPS_SP_SERV_SE_AP_EXPEDITED';
        $services['SE']['AP'][] = 'UPS_SP_SERV_SE_AP_EXPRESS_SAVER';
        $services['SE']['AP'][] = 'UPS_SP_SERV_SE_AP_UPS_EXPRESS12';
        $services['SE']['AP'][] = 'UPS_SP_SERV_SE_AP_EXPRESS';
        $services['SE']['AP'][] = 'UPS_SP_SERV_SE_AP_EXPRESS_SAT_DELI';
        $services['SE']['AP'][] = 'UPS_SP_SERV_SE_AP_EXPRESS_PLUS';

        $services['SE']['ADD'][] = 'UPS_SP_SERV_SE_ADD_STANDARD';
        $services['SE']['ADD'][] = 'UPS_SP_SERV_SE_ADD_STANDARD_SAT_DELI';
        $services['SE']['ADD'][] = 'UPS_SP_SERV_SE_ADD_EXPEDITED';
        $services['SE']['ADD'][] = 'UPS_SP_SERV_SE_ADD_EXPRESS_SAVER';
        $services['SE']['ADD'][] = 'UPS_SP_SERV_SE_ADD_EXPRESS12';
        $services['SE']['ADD'][] = 'UPS_SP_SERV_SE_ADD_EXPRESS';
        $services['SE']['ADD'][] = 'UPS_SP_SERV_SE_ADD_EXPRESS_SAT_DELI';
        $services['SE']['ADD'][] = 'UPS_SP_SERV_SE_ADD_EXPRESS_PLUS';

        $services['NO']['AP'][] = 'UPS_SP_SERV_NO_AP_STANDARD';
        $services['NO']['AP'][] = 'UPS_SP_SERV_NO_AP_STANDARD_SAT_DELI';
        $services['NO']['AP'][] = 'UPS_SP_SERV_NO_AP_EXPEDITED';
        $services['NO']['AP'][] = 'UPS_SP_SERV_NO_AP_EXPRESS_SAVER';
        $services['NO']['AP'][] = 'UPS_SP_SERV_NO_AP_UPS_EXPRESS12';
        $services['NO']['AP'][] = 'UPS_SP_SERV_NO_AP_EXPRESS';
        $services['NO']['AP'][] = 'UPS_SP_SERV_NO_AP_EXPRESS_SAT_DELI';
        $services['NO']['AP'][] = 'UPS_SP_SERV_NO_AP_EXPRESS_PLUS';

        $services['NO']['ADD'][] = 'UPS_SP_SERV_NO_ADD_STANDARD';
        $services['NO']['ADD'][] = 'UPS_SP_SERV_NO_ADD_STANDARD_SAT_DELI';
        $services['NO']['ADD'][] = 'UPS_SP_SERV_NO_ADD_EXPEDITED';
        $services['NO']['ADD'][] = 'UPS_SP_SERV_NO_ADD_EXPRESS_SAVER';
        $services['NO']['ADD'][] = 'UPS_SP_SERV_NO_ADD_EXPRESS12';
        $services['NO']['ADD'][] = 'UPS_SP_SERV_NO_ADD_EXPRESS';
        $services['NO']['ADD'][] = 'UPS_SP_SERV_NO_ADD_EXPRESS_SAT_DELI';
        $services['NO']['ADD'][] = 'UPS_SP_SERV_NO_ADD_EXPRESS_PLUS';

        $services['RS']['AP'][] = 'UPS_SP_SERV_RS_AP_STANDARD';
        $services['RS']['AP'][] = 'UPS_SP_SERV_RS_AP_STANDARD_SAT_DELI';
        $services['RS']['AP'][] = 'UPS_SP_SERV_RS_AP_EXPEDITED';
        $services['RS']['AP'][] = 'UPS_SP_SERV_RS_AP_EXPRESS_SAVER';
        $services['RS']['AP'][] = 'UPS_SP_SERV_RS_AP_UPS_EXPRESS12';
        $services['RS']['AP'][] = 'UPS_SP_SERV_RS_AP_EXPRESS';
        $services['RS']['AP'][] = 'UPS_SP_SERV_RS_AP_EXPRESS_SAT_DELI';
        $services['RS']['AP'][] = 'UPS_SP_SERV_RS_AP_EXPRESS_PLUS';

        $services['RS']['ADD'][] = 'UPS_SP_SERV_RS_ADD_STANDARD';
        $services['RS']['ADD'][] = 'UPS_SP_SERV_RS_ADD_STANDARD_SAT_DELI';
        $services['RS']['ADD'][] = 'UPS_SP_SERV_RS_ADD_EXPEDITED';
        $services['RS']['ADD'][] = 'UPS_SP_SERV_RS_ADD_EXPRESS_SAVER';
        $services['RS']['ADD'][] = 'UPS_SP_SERV_RS_ADD_EXPRESS12';
        $services['RS']['ADD'][] = 'UPS_SP_SERV_RS_ADD_EXPRESS';
        $services['RS']['ADD'][] = 'UPS_SP_SERV_RS_ADD_EXPRESS_SAT_DELI';
        $services['RS']['ADD'][] = 'UPS_SP_SERV_RS_ADD_EXPRESS_PLUS';

        $services['CH']['AP'][] = 'UPS_SP_SERV_CH_AP_STANDARD';
        $services['CH']['AP'][] = 'UPS_SP_SERV_CH_AP_STANDARD_SAT_DELI';
        $services['CH']['AP'][] = 'UPS_SP_SERV_CH_AP_EXPEDITED';
        $services['CH']['AP'][] = 'UPS_SP_SERV_CH_AP_EXPRESS_SAVER';
        $services['CH']['AP'][] = 'UPS_SP_SERV_CH_AP_UPS_EXPRESS12';
        $services['CH']['AP'][] = 'UPS_SP_SERV_CH_AP_EXPRESS';
        $services['CH']['AP'][] = 'UPS_SP_SERV_CH_AP_EXPRESS_SAT_DELI';
        $services['CH']['AP'][] = 'UPS_SP_SERV_CH_AP_EXPRESS_PLUS';

        $services['CH']['ADD'][] = 'UPS_SP_SERV_CH_ADD_STANDARD';
        $services['CH']['ADD'][] = 'UPS_SP_SERV_CH_ADD_STANDARD_SAT_DELI';
        $services['CH']['ADD'][] = 'UPS_SP_SERV_CH_ADD_EXPEDITED';
        $services['CH']['ADD'][] = 'UPS_SP_SERV_CH_ADD_EXPRESS_SAVER';
        $services['CH']['ADD'][] = 'UPS_SP_SERV_CH_ADD_EXPRESS12';
        $services['CH']['ADD'][] = 'UPS_SP_SERV_CH_ADD_EXPRESS';
        $services['CH']['ADD'][] = 'UPS_SP_SERV_CH_ADD_EXPRESS_SAT_DELI';
        $services['CH']['ADD'][] = 'UPS_SP_SERV_CH_ADD_EXPRESS_PLUS';

        $services['IS']['AP'][] = 'UPS_SP_SERV_IS_AP_STANDARD';
        $services['IS']['AP'][] = 'UPS_SP_SERV_IS_AP_STANDARD_SAT_DELI';
        $services['IS']['AP'][] = 'UPS_SP_SERV_IS_AP_EXPEDITED';
        $services['IS']['AP'][] = 'UPS_SP_SERV_IS_AP_EXPRESS_SAVER';
        $services['IS']['AP'][] = 'UPS_SP_SERV_IS_AP_UPS_EXPRESS12';
        $services['IS']['AP'][] = 'UPS_SP_SERV_IS_AP_EXPRESS';
        $services['IS']['AP'][] = 'UPS_SP_SERV_IS_AP_EXPRESS_SAT_DELI';
        $services['IS']['AP'][] = 'UPS_SP_SERV_IS_AP_EXPRESS_PLUS';

        $services['IS']['ADD'][] = 'UPS_SP_SERV_IS_ADD_STANDARD';
        $services['IS']['ADD'][] = 'UPS_SP_SERV_IS_ADD_STANDARD_SAT_DELI';
        $services['IS']['ADD'][] = 'UPS_SP_SERV_IS_ADD_EXPEDITED';
        $services['IS']['ADD'][] = 'UPS_SP_SERV_IS_ADD_EXPRESS_SAVER';
        $services['IS']['ADD'][] = 'UPS_SP_SERV_IS_ADD_EXPRESS12';
        $services['IS']['ADD'][] = 'UPS_SP_SERV_IS_ADD_EXPRESS';
        $services['IS']['ADD'][] = 'UPS_SP_SERV_IS_ADD_EXPRESS_SAT_DELI';
        $services['IS']['ADD'][] = 'UPS_SP_SERV_IS_ADD_EXPRESS_PLUS';

        $services['JE']['AP'][] = 'UPS_SP_SERV_JE_AP_STANDARD';
        $services['JE']['AP'][] = 'UPS_SP_SERV_JE_AP_STANDARD_SAT_DELI';
        $services['JE']['AP'][] = 'UPS_SP_SERV_JE_AP_EXPEDITED';
        $services['JE']['AP'][] = 'UPS_SP_SERV_JE_AP_EXPRESS_SAVER';
        $services['JE']['AP'][] = 'UPS_SP_SERV_JE_AP_UPS_EXPRESS12';
        $services['JE']['AP'][] = 'UPS_SP_SERV_JE_AP_EXPRESS';
        $services['JE']['AP'][] = 'UPS_SP_SERV_JE_AP_EXPRESS_SAT_DELI';
        $services['JE']['AP'][] = 'UPS_SP_SERV_JE_AP_EXPRESS_PLUS';

        $services['JE']['ADD'][] = 'UPS_SP_SERV_JE_ADD_STANDARD';
        $services['JE']['ADD'][] = 'UPS_SP_SERV_JE_ADD_STANDARD_SAT_DELI';
        $services['JE']['ADD'][] = 'UPS_SP_SERV_JE_ADD_EXPEDITED';
        $services['JE']['ADD'][] = 'UPS_SP_SERV_JE_ADD_EXPRESS_SAVER';
        $services['JE']['ADD'][] = 'UPS_SP_SERV_JE_ADD_EXPRESS12';
        $services['JE']['ADD'][] = 'UPS_SP_SERV_JE_ADD_EXPRESS';
        $services['JE']['ADD'][] = 'UPS_SP_SERV_JE_ADD_EXPRESS_SAT_DELI';
        $services['JE']['ADD'][] = 'UPS_SP_SERV_JE_ADD_EXPRESS_PLUS';

        $services['TR']['AP'][] = 'UPS_SP_SERV_TR_AP_STANDARD';
        $services['TR']['AP'][] = 'UPS_SP_SERV_TR_AP_STANDARD_SAT_DELI';
        $services['TR']['AP'][] = 'UPS_SP_SERV_TR_AP_EXPEDITED';
        $services['TR']['AP'][] = 'UPS_SP_SERV_TR_AP_EXPRESS_SAVER';
        $services['TR']['AP'][] = 'UPS_SP_SERV_TR_AP_UPS_EXPRESS12';
        $services['TR']['AP'][] = 'UPS_SP_SERV_TR_AP_EXPRESS';
        $services['TR']['AP'][] = 'UPS_SP_SERV_TR_AP_EXPRESS_SAT_DELI';
        $services['TR']['AP'][] = 'UPS_SP_SERV_TR_AP_EXPRESS_PLUS';

        $services['TR']['ADD'][] = 'UPS_SP_SERV_TR_ADD_STANDARD';
        $services['TR']['ADD'][] = 'UPS_SP_SERV_TR_ADD_STANDARD_SAT_DELI';
        $services['TR']['ADD'][] = 'UPS_SP_SERV_TR_ADD_EXPEDITED';
        $services['TR']['ADD'][] = 'UPS_SP_SERV_TR_ADD_EXPRESS_SAVER';
        $services['TR']['ADD'][] = 'UPS_SP_SERV_TR_ADD_EXPRESS12';
        $services['TR']['ADD'][] = 'UPS_SP_SERV_TR_ADD_EXPRESS';
        $services['TR']['ADD'][] = 'UPS_SP_SERV_TR_ADD_EXPRESS_SAT_DELI';
        $services['TR']['ADD'][] = 'UPS_SP_SERV_TR_ADD_EXPRESS_PLUS';

        if (!empty($countryCode)) {
            if (empty($serviceType)) {
                $result = [];
                $result = array_merge($services[$countryCode]["AP"], $services[$countryCode]["ADD"]);
                return $result;
            }

            return $services[$countryCode][$serviceType];
        }
        return [];
    }

    /**
     * SortedServices getListSortedServices
     *
     * @param array $sortedServices //The list shipping services
     * @param array $listServices //The sorted service
     *
     * @return array $data
     */
    public function getListSortedServices($sortedServices, $listServices)
    {
        $resultServices = [];
        if (is_array($listServices) && !empty($listServices)
            && is_array($sortedServices) && !empty($sortedServices)) {
            foreach ($sortedServices as $service_key) {
                $index = array_search($service_key, array_column($listServices, 'service_key'));
                if (gettype($index) == "integer") {
                    $resultServices[] = $listServices[$index];
                }
            }
        }
        return $resultServices;
    }
}
