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

/**
 * Class ShippingAddress
 *
 * Extended Address object used as shipping address in a payment.
 *
 * @package PayU\Api
 *
 * @property string recipient_name
 */
class ShippingAddress extends Address
{
    /**
     * Name of the recipient at this address.
     *
     * @param string $recipient_name
     *
     * @return $this
     */
    public function setRecipientName($recipient_name)
    {
        $this->recipient_name = $recipient_name;
        return $this;
    }

    /**
     * Name of the recipient at this address.
     *
     * @return string
     */
    public function getRecipientName()
    {
        return $this->recipient_name;
    }
}
