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
 * Class Customer
 *
 * A resource representing a customer that funds a payment.
 *
 * @package PayU\Api
 *
 * @property string payment_method
 * @property string ip_address
 * @property \PayU\Api\FundingInstrument funding_instrument
 * @property \PayU\Api\CustomerInfo customer_info
 */
class Customer extends PayUModel
{
    /**
     * Payment method being used - Credit card, PayU Wallet payment, Eft.
     * Valid Values: ["creditcard", "eft_pro", "ebucks", "discoverymiles", "smarteft"]
     *
     * @param string $payment_method
     *
     * @return $this
     */
    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
        return $this;
    }

    /**
     * Payment method being used - Credit card, PayU Wallet payment, Eft.
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * IP address of customer system.
     *
     * @return $this
     */
    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;
        return $this;
    }

    /**
     * IP address of customer system.
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * Funding instrument to fund the payment.
     *
     * @return \PayU\Api\FundingInstrument
     */
    public function getFundingInstruments()
    {
        return $this->funding_instrument;
    }

    /**
     * Funding instrument to fund the payment.
     *
     * @param \PayU\Api\FundingInstrument $funding_instrument
     *
     * @return $this
     */
    public function setFundingInstrument($funding_instrument)
    {
        $this->funding_instrument = $funding_instrument;
        return $this;
    }

    /**
     * Information related to the Customer.
     *
     * @param \PayU\Api\CustomerInfo $customer_info
     *
     * @return $this
     */
    public function setCustomerInfo($customer_info)
    {
        $this->customer_info = $customer_info;
        return $this;
    }

    /**
     * Information related to the Payer.
     *
     * @return \PayU\Api\CustomerInfo
     */
    public function getCustomerInfo()
    {
        return $this->customer_info;
    }
}
