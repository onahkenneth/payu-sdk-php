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
 * Class FundingInstrument
 *
 * A resource representing a Customer's funding instrument.
 * An instance of this schema is valid if and only if it is valid against exactly one of these supported properties
 *
 * @package PayU\Api
 *
 * @property boolean store_card
 * @property \PayU\Api\CreditCard credit_card
 * @property \PayU\Api\CreditCardToken credit_card_token
 * @property \PayU\Api\Billing billing
 */
class FundingInstrument extends PayUModel
{
    /**
     * Credit Card instrument.
     *
     * @param \PayU\Api\CreditCard $credit_card
     *
     * @return $this
     */
    public function setCreditCard($credit_card)
    {
        $this->credit_card = $credit_card;
        return $this;
    }

    /**
     * Credit Card instrument.
     *
     * @return \PayU\Api\CreditCard
     */
    public function getCreditCard()
    {
        return $this->credit_card;
    }

    /**
     * PayU vaulted credit Card instrument.
     *
     * @param \PayU\Api\CreditCardToken $credit_card_token
     *
     * @return $this
     */
    public function setCreditCardToken($credit_card_token)
    {
        $this->credit_card_token = $credit_card_token;
        return $this;
    }

    /**
     * PayU vaulted credit Card instrument.
     *
     * @return \PayU\Api\CreditCardToken
     */
    public function getCreditCardToken()
    {
        return $this->credit_card_token;
    }

    /**
     * Payment Card information.
     *
     * @param \PayU\Api\PaymentCard $payment_card
     *
     * @return $this
     */
    public function setPaymentCard($payment_card)
    {
        $this->payment_card = $payment_card;
        return $this;
    }

    /**
     * Payment Card information.
     *
     * @return \PayU\Api\PaymentCard
     */
    public function getPaymentCard()
    {
        return $this->payment_card;
    }

    /**
     * Billing instrument that references pre-approval information for the payment
     *
     * @param \PayU\Api\Billing $billing
     *
     * @return $this
     */
    public function setBilling($billing)
    {
        $this->billing = $billing;
        return $this;
    }

    /**
     * Billing instrument that references pre-approval information for the payment
     *
     * @return \PayU\Api\Billing
     */
    public function getBilling()
    {
        return $this->billing;
    }

    /**
     * Save payment card details for future payment.
     *
     * @return $this
     */
    public function setStoreCard($store = false)
    {
        $this->store_card = $store;

        return $this;
    }

    /**
     * Save payment card details for future payment.
     *
     * @return boolean
     */
    public function getStoreCard()
    {
        return $this->store_card;
    }
}
