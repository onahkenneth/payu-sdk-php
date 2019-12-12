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
 * Class BaseAddress
 *
 * Base Address object used as billing
 * address in a payment or extended for Shipping Address.
 *
 * @package PayU\Api
 *
 * @property string line1
 * @property string line2
 * @property string city
 * @property string country_code
 * @property string postal_code
 * @property string state
 */
class BaseAddress extends PayUModel
{
    /**
     * Line 1 of the Address (eg. number, street, etc).
     *
     * @param string $line1
     *
     * @return $this
     */
    public function setLine1($line1)
    {
        $this->line1 = $line1;
        return $this;
    }

    /**
     * Line 1 of the Address (eg. number, street, etc).
     *
     * @return string
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * Optional line 2 of the Address (eg. suite, apt #, etc.).
     *
     * @param string $line2
     *
     * @return $this
     */
    public function setLine2($line2)
    {
        $this->line2 = $line2;
        return $this;
    }

    /**
     * Optional line 2 of the Address (eg. suite, apt #, etc.).
     *
     * @return string
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * City name.
     *
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * City name.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * 2 letter country code.
     *
     * @param string $country_code
     *
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
        return $this;
    }

    /**
     * 2 letter country code.
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Postal code or equivalent is usually required for countries that have them.
     *
     * @param string $postal_code
     *
     * @return $this
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
        return $this;
    }

    /**
     * Postal code or equivalent is usually required for countries that have them.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * 2 letter code for US states, and the equivalent for other countries.
     *
     * @param string $state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * 2 letter code for US states, and the equivalent for other countries.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }
}
