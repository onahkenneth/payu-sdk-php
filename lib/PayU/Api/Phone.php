<?php
/**
 * PayU EMEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Model\PayUModel;

/**
 * Class Phone
 *
 * Information related to the Merchant.
 *
 * @package PayU\Api
 *
 * @property string countryCode
 * @property string nationalNumber
 * @property string extension
 */
class Phone extends PayUModel
{
    /**
     * Country code (from in E.164 format)
     *
     * @param string $countryCode
     *
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * Country code (from in E.164 format)
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * In-country phone number (from in E.164 format)
     *
     * @param string $national_number
     *
     * @return $this
     */
    public function setNationalNumber($nationalNumber)
    {
        $this->nationalNumber = $nationalNumber;
        return $this;
    }

    /**
     * In-country phone number (from in E.164 format)
     *
     * @return string
     */
    public function getNationalNumber()
    {
        return $this->nationalNumber;
    }

    /**
     * Phone extension
     *
     * @param string $extension
     *
     * @return $this
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * Phone extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }
}
