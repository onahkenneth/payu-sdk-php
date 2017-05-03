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
 * @property \PayU\Api\CustomFields[] customFields
 * @property \PayU\Api\LookupData lookupData
 * @property \PayU\Api\PaymentMethod paymentMethodsUsed
 * @property \PayU\Api\RecurringDetails recurringDetails
 * @property \PayU\Api\EFTBase redirect
 * @property \PayU\Api\FmDetails fraud
 */
class Response extends PayUModel
{
    /**
     * Checks if transaction is successful
     *
     * @return boolean
     */
    public function getSuccessful()
    {
        return $this->successful;
    }

    /**
     * Checks if transaction is successful
     *
     * @param $successful
     */
    public function setSuccessful($successful)
    {
        $this->successful = $successful;
    }

    /**
     * User friendly display message
     *
     * @return string
     */
    public function getDisplayMessage()
    {
        return $this->displayMessage;
    }

    /**
     * User friendly display message
     *
     * @param $displayMessage
     */
    public function setDisplayMessage($displayMessage)
    {
        $this->displayMessage = $displayMessage;
    }

    /**
     * PayU unique identifier of transaction
     *
     * @return string
     */
    public function getPayUReference()
    {
        return $this->payUReference;
    }

    /**
     * PayU unique identifier of transaction.
     *
     * @param $payUReference
     */
    public function setPayUReference($payUReference)
    {
        $this->payUReference = $payUReference;
    }

    /**
     * Merchant specified identifier of transaction. Maybe unique or otherwise.
     *
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * Merchant specified identifier of transaction. Maybe unique or otherwise.
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
     * System result code
     *
     * @return string
     */
    public function getResultCode()
    {
        return $this->resultCode;
    }

    /**
     * System result code
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
     * System result message
     *
     * @return string
     */
    public function getResultMessage()
    {
        return $this->resultMessage;
    }

    /**
     * System result message
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
     * Type payment transaction
     *
     * @return string
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     * Type payment transaction
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
     * Transaction state
     *
     * @return string
     */
    public function getTransactionState()
    {
        return $this->transactionState;
    }

    /**
     * Transaction state
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
     * Cart summary
     *
     * @return \PayU\Api\Basket
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * Cart summary
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
     * Secure 3D
     *
     * @return \PayU\Api\Secure3D
     */
    public function getSecure3D()
    {
        return $this->secure3D;
    }

    /**
     * Secure 3D
     *
     * @param array $secure3D
     *
     * @return $this
     */
    public function setSecure3D($secure3D)
    {
        $this->secure3D = $secure3D;
        return $this;
    }

    /**
     * Payment methods used by user to fund payment
     *
     * @return \PayU\Api\PaymentMethod
     */
    public function getPaymentMethodsUsed()
    {
        return $this->paymentMethodsUsed;
    }

    /**
     * Payment methods used by user to fund payment
     *
     * @param array $paymentMethodsUsed
     *
     * @return $this
     */
    public function setPaymentMethodsUsed($paymentMethodsUsed)
    {
        $this->paymentMethodsUsed = $paymentMethodsUsed;
        return $this;
    }

    /**
     * Debit order recurring payment details
     *
     * @return \PayU\Api\RecurringDetails
     */
    public function getRecurringDetails()
    {
        return $this->recurringDetails;
    }

    /**
     * Debit order recurring payment details
     *
     * @param $recurringDetails
     */
    public function setRecurringDetails($recurringDetails)
    {
        $this->recurringDetails = $recurringDetails;
    }

    /**
     * EFT funding instrument details.
     *
     * @return \PayU\Api\EFTBase
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * EFT funding instrument details
     *
     * @param $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * Fraud management details.
     *
     * @return \PayU\Api\FmDetails
     */
    public function getFraud()
    {
        return $this->fraud;
    }

    /**
     * Fraud management details.
     *
     * @param $fraud
     */
    public function setFraud($fraud)
    {
        $this->fraud = $fraud;
    }

    /**
     * Append CustomFields to the list.
     *
     * @param \PayU\Api\CustomFields $customFields
     * @return $this
     */
    public function addCustomFields($customFields)
    {
        if (!$this->getCustomFields()) {
            return $this->setCustomFields(array($customFields));
        } else {
            return $this->setCustomFields(
                array_merge($this->getCustomFields(), array($customFields))
            );
        }
    }

    /**
     * Custom key-value pair fields.
     *
     * @return \PayU\Api\CustomFields[]
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }

    /**
     * Custom key-value pair fields.
     *
     * @param $customFields
     */
    public function setCustomFields($customFields)
    {
        $this->customFields = $customFields;
    }

    /**
     * Remove CustomFields from the list.
     *
     * @param \PayU\Api\CustomFields $customFields
     * @return $this
     */
    public function removeCustomFields($customFields)
    {
        return $this->setCustomFields(
            array_diff($this->getCustomFields(), array($customFields))
        );
    }

    /**
     * Key-value pair fields returned from a transaction lookup.
     *
     * @return \PayU\Api\LookupData
     */
    public function getLookupData()
    {
        return $this->lookupData;
    }

    /**
     * Key-value pair fields returned from a transaction lookup.
     *
     * @param \PayU\Api\LookupData
     */
    public function setLookupData($lookupData)
    {
        $this->lookupData = $lookupData;
    }

}
