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
 * Class Response
 *
 * Response class contains response from SOAP method call
 *
 * @package PayU\Api
 *
 * @property string displayMessage
 * @property string merchantReference
 * @property string payUReference
 * @property string resultCode
 * @property string resultMessage
 * @property boolean successful
 * @property string transactionType
 * @property string transactionState
 * @property \PayU\Api\Basket basket
 * @property \PayU\Api\Secure3D secure3D
 * @property \PayU\Api\LookupData lookupData
 * @property \PayU\Api\PaymentMethod paymentMethodsUsed
 */
class Response extends PayUModel
{
    /**
     *
     * @return boolean
     */
    public function getSuccessful()
    {
        return $this->successful;
    }

    /**
     *
     * @param $successful
     */
    public function setSuccessful($successful)
    {
        $this->successful = $successful;
    }

    /**
     *
     * @return string
     */
    public function getDisplayMessage()
    {
        return $this->displayMessage;
    }

    /**
     *
     * @param $displayMessage
     */
    public function setDisplayMessage($displayMessage)
    {
        $this->displayMessage = $displayMessage;
    }

    /**
     *
     * @return string
     */
    public function getPayUReference()
    {
        return $this->payUReference;
    }

    /**
     *
     * @param $payUReference
     */
    public function setPayUReference($payUReference)
    {
        $this->payUReference = $payUReference;
    }

    /**
     *
     *
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     *
     *
     * @param string $merchantReference
     * @return $this
     */
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;
        return $this;
    }

    /**
     *
     *
     * @return string
     */
    public function getResultCode()
    {
        return $this->resultCode;
    }

    /**
     *
     *
     * @param string $resultCode
     * @return $this
     */
    public function setResultCode($resultCode)
    {
        $this->resultCode = $resultCode;
        return $this;
    }

    /**
     *
     *
     * @return string
     */
    public function getResultMessage()
    {
        return $this->resultMessage;
    }

    /**
     *
     *
     * @param string $resultMessage
     * @return $this
     */
    public function setResultMessage($resultMessage)
    {
        $this->resultMessage = $resultMessage;
        return $this;
    }

    /**
     *
     *
     * @return string
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     *
     *
     * @param string $transactionType
     * @return $this
     */
    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
        return $this;
    }

    /**
     *
     *
     * @return string
     */
    public function getTransactionState()
    {
        return $this->transactionState;
    }

    /**
     *
     *
     * @param string $transactionState
     * @return $this
     */
    public function setTransactionState($transactionState)
    {
        $this->transactionState = $transactionState;
        return $this;
    }

    /**
     *
     *
     * @return \PayU\Api\Basket
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     *
     *
     * @param array $basket
     * @return $this
     */
    public function setBasket($basket)
    {
        $this->basket = $basket;
        return $this;
    }

    /**
     *
     *
     * @return \PayU\Api\Secure3D
     */
    public function getSecure3D()
    {
        return $this->secure3D;
    }

    /**
     * Secure3D
     *
     * @param array $secure3D
     * @return $this
     */
    public function setSecure3D($secure3D)
    {
        $this->secure3D = $secure3D;
        return $this;
    }

    /**
     * Secure3D
     *
     * @return \PayU\Api\PaymentMethod
     */
    public function getPaymentMethodsUsed()
    {
        return $this->paymentMethod;
    }

    /**
     *
     *
     * @param array $paymentMethodsUsed
     * @return $this
     */
    public function setPaymentMethodsUsed($paymentMethodsUsed)
    {
        $this->paymentMethodsUsed = $paymentMethodsUsed;
        return $this;
    }
}
