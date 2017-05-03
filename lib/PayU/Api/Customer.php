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

use PayU\Model\PayUModel;

/**
 * Class Customer
 *
 * A resource representing a customer that funds a payment.
 *
 * @package PayU\Api
 *
 * @property string ipAddress
 * @property string paymentMethod
 * @property \PayU\Api\FundingInstrument fundingInstrument
 * @property \PayU\Api\CustomerInfo customerInfo
 */
class Customer extends PayUModel
{
    /**
     * Payment method being used - Credit card, PayU Wallet payment, Eft.
     * Valid Values: ["CREDITCARD", "EFT_PRO", "EBUCKS", "DISCOVERYMILES", "SMARTEFT", "DEBIT_ORDER", "CREDITCARD_TOKEN", "REAL_TIME_RECURRING"]
     *
     * @param string $paymentMethod
     *
     * @return $this
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * Payment method being used - Credit card, PayU Wallet payment, Eft.
     * Valid Values: ["CREDITCARD", "EFT_PRO", "EBUCKS", "DISCOVERYMILES", "SMARTEFT", "DEBIT_ORDER", "CREDITCARD_TOKEN", "REAL_TIME_RECURRING"]
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * IP address of customer system.
     *
     * @return $this
     */
    public function setIPAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    /**
     * IP address of customer system.
     *
     * @return string
     */
    public function getIPAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Funding instrument to fund the payment.
     *
     * @return \PayU\Api\FundingInstrument
     */
    public function getFundingInstrument()
    {
        return $this->fundingInstrument;
    }

    /**
     * Funding instrument to fund the payment.
     *
     * @param \PayU\Api\FundingInstrument $fundingInstrument
     *
     * @return $this
     */
    public function setFundingInstrument($fundingInstrument)
    {
        $this->fundingInstrument = $fundingInstrument;
        return $this;
    }

    /**
     * Information related to the Customer.
     *
     * @param \PayU\Api\CustomerInfo $customerInfo
     *
     * @return $this
     */
    public function setCustomerInfo($customerInfo)
    {
        $this->customerInfo = $customerInfo;
        return $this;
    }

    /**
     * Information related to the Payer.
     *
     * @return \PayU\Api\CustomerInfo
     */
    public function getCustomerInfo()
    {
        return $this->customerInfo;
    }

    /**
     * Alias of CustomerInfo <code>getId()</code> method
     *
     * @return string
     */
    public function getId()
    {
        return $this->customerInfo->customerId;
    }
}
