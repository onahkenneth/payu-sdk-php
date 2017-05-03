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
 * @property boolean storeCard
 * @property \PayU\Api\CreditCard creditCard
 * @property \PayU\Api\PaymentCard paymentCard
 * @property \PayU\Api\Ebucks ebucks
 * @property \PayU\Api\EFTBase eft
 * @property \PayU\Api\CreditCardToken creditCardToken
 *
 * @package PayU\Api
 */
class FundingInstrument extends PayUModel
{
    /**
     * Credit Card instrument.
     *
     * @param \PayU\Api\CreditCard $creditCard
     *
     * @return $this
     */
    public function setCreditCard($creditCard)
    {
        $this->creditCard = $creditCard;
        return $this;
    }

    /**
     * Credit Card instrument.
     *
     * @return \PayU\Api\CreditCard
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * PayU vaulted credit Card instrument.
     *
     * @param \PayU\Api\CreditCardToken $creditCardToken
     *
     * @return $this
     */
    public function setCreditCardToken($creditCardToken)
    {
        $this->creditCardToken = $creditCardToken;
        return $this;
    }

    /**
     * PayU vaulted credit Card instrument.
     *
     * @return \PayU\Api\CreditCardToken
     */
    public function getCreditCardToken()
    {
        return $this->creditCardToken;
    }

    /**
     * Payment Card information.
     *
     * @param \PayU\Api\PaymentCard $paymentCard
     *
     * @return $this
     */
    public function setPaymentCard($paymentCard)
    {
        $this->paymentCard = $paymentCard;
        return $this;
    }

    /**
     * Payment Card information.
     *
     * @return \PayU\Api\PaymentCard
     */
    public function getPaymentCard()
    {
        return $this->paymentCard;
    }

    /**
     * Save payment card details for future payment.
     *
     * @return $this
     */
    public function setStoreCard($store)
    {
        $this->storeCard = $store;

        return $this;
    }

    /**
     * Save payment card details for future payment.
     *
     * @return boolean
     */
    public function getStoreCard()
    {
        return $this->storeCard;
    }

    /**
     * eBucks payment details.
     *
     * @param \PayU\Api\Ebucks $ebucks
     *
     * @return $this
     */
    public function setEbucks($ebucks)
    {
        $this->ebucks = $ebucks;

        return $this;
    }

    /**
     * eBucks payment details.
     *
     * @return \PayU\Api\Ebucks
     */
    public function getEbucks()
    {
        return $this->ebucks;
    }

    /**
     * EFT funding instrument details.
     *
     * @param \PayU\Api\EFTBase $eft
     *
     * @return $this
     */
    public function setEft($eft)
    {
        $this->eft = $eft;

        return $this;
    }

    /**
     * EFT funding instrument details.
     *
     * @return \PayU\Api\EFTBase
     */
    public function getEft()
    {
        return $this->eft;
    }
}
