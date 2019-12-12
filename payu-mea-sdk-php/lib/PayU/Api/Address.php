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
 * property \PayU\Api\Phone phone
 */
class Address extends BaseAddress
{
    /**
     * Phone number in E.123 format.
     *
     * @param \PayU\Api\Phone $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Phone number in E.123 format.
     *
     * @return \PayU\Api\Phone
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
