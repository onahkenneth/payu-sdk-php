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
 * @property \PayU\Api\FundingInstrument[] funding_instruments
 * @property \PayU\Api\CustomerInfo customer_info
 */
class Customer extends PayUModel
{
    /**
     * Payment method being used - PayU Wallet payment, Bank Direct Debit  or Direct Credit card.
     * Valid Values: ["CREDITCARD", "EFT_PRO", "DEBITCARD", "EBUCKS", "DICOVERYMILES", "SMARTEFT"]
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
     * Payment method being used - Bank Direct Debit  or Direct Credit card etc.
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * Append FundingInstruments to the list.
     *
     * @param \PayU\Api\FundingInstrument $fundingInstrument
     *
     * @return $this
     */
    public function addFundingInstrument($fundingInstrument)
    {
        if (!$this->getFundingInstruments()) {
            return $this->setFundingInstruments(array($fundingInstrument));
        } else {
            return $this->setFundingInstruments(
                array_merge($this->getFundingInstruments(), array($fundingInstrument))
            );
        }
    }

    /**
     * List of funding instruments to fund the payment. 'OneOf' funding_instruments,
     * funding_option_id to be used to identify the specifics of payment method passed.
     *
     * @return \PayU\Api\FundingInstrument[]
     */
    public function getFundingInstruments()
    {
        return $this->funding_instruments;
    }

    /**
     * List of funding instruments to fund the payment. 'OneOf' funding_instruments,
     * funding_option_id to be used to identify the specifics of payment method passed.
     *
     * @param \PayU\Api\FundingInstrument[] $funding_instruments
     *
     * @return $this
     */
    public function setFundingInstruments($funding_instruments)
    {
        $this->funding_instruments = $funding_instruments;
        return $this;
    }

    /**
     * Remove FundingInstruments from the list.
     *
     * @param \PayU\Api\FundingInstrument $fundingInstrument
     *
     * @return $this
     */
    public function removeFundingInstrument($fundingInstrument)
    {
        return $this->setFundingInstruments(
            array_diff($this->getFundingInstruments(), array($fundingInstrument))
        );
    }

    /**
     * Id of user selected funding option for the payment.'OneOf' funding_instruments,
     * funding_option_id to be used to identify the specifics of payment method passed.
     *
     * @deprecated Not publicly available
     *
     * @param string $funding_option_id
     *
     * @return $this
     */
    public function setFundingOptionId($funding_option_id)
    {
        $this->funding_option_id = $funding_option_id;
        return $this;
    }

    /**
     * Id of user selected funding option for the payment.'OneOf' funding_instruments,
     * funding_option_id to be used to identify the specifics of payment method passed.
     *
     * @deprecated Not publicly available
     * @return string
     */
    public function getFundingOptionId()
    {
        return $this->funding_option_id;
    }

    /**
     * Default funding option available for the payment
     *
     * @deprecated Not publicly available
     *
     * @param \PayU\Api\FundingOption $funding_option
     *
     * @return $this
     */
    public function setFundingOption($funding_option)
    {
        $this->funding_option = $funding_option;
        return $this;
    }

    /**
     * Default funding option available for the payment
     *
     * @deprecated Not publicly available
     * @return \PayU\Api\FundingOption
     */
    public function getFundingOption()
    {
        return $this->funding_option;
    }

    /**
     * Information related to the Payer.
     *
     * @param \PayU\Api\CustomerInfo $payer_info
     *
     * @return $this
     */
    public function setPayerInfo($payer_info)
    {
        $this->payer_info = $payer_info;
        return $this;
    }

    /**
     * Information related to the Payer.
     *
     * @return \PayU\Api\CustomerInfo
     */
    public function getPayerInfo()
    {
        return $this->payer_info;
    }
}
