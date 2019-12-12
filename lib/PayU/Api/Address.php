<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

/**
 * Class Address
 *
 * Address object used as customer address in a payment or extended for Shipping Address.
 *
 * @package PayU\Api
 *
 * @property string phone
 */
class Address extends BaseAddress
{
    /**
     * Phone number representing the Customer 20 characters max.
     *
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Phone number representing the Customer. 20 characters max.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
