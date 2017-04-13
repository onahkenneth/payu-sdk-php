<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Model\PayUModel;

/**
 * Class RecurringDetails
 *
 * The details of Debit Order payment setup on the customer account
 *
 * A transaction defines the contract of a payment - what is the payment
 * for and who is fulfilling it.
 *
 * @package PaU\Api
 *
 * @property string recurrences
 * @property string statementDescription
 * @property string managedBy
 * @property string startDate
 * @property string anonymousUser
 * @property string frequency
 * @property string deductionDay
 * @property array callCenterRepId
 * @property string recurringPaymentToken
 */
class RecurringDetails extends PayUModel
{
    /**
     * Number of recurrences
     *
     * @param  string $recurrences
     * @return $this
     */
    public function setRecurrences($recurrences)
    {
        $this->recurrences = $recurrences;
        return $this;
    }

    /**
     * Number of recurrences
     *
     * @return  string
     */
    public function getRecurrences()
    {
        return $this->recurrences;
    }

    /**
     * Debit order statement description
     *
     * @param  string $statementDescription
     * @return $this
     */
    public function setStatementDescription($statementDescription)
    {
        $this->statementDescription = $statementDescription;
        return $this;
    }

    /**
     * Debit order statement description
     *
     * @return  string
     */
    public function getStatementDescription()
    {
        return $this->statementDescription;
    }

    /**
     * Debit order account management
     * Valid values: [PAYU, MERCHANT]
     *
     * @param  string $managedBy
     * @return $this
     */
    public function setManagedBy($managedBy)
    {
        $this->managedBy = $managedBy;
        return $this;
    }

    /**
     * Debit order account management
     * Valid values: [PAYU, MERCHANT]
     *
     * @return  string
     */
    public function getManagedBy()
    {
        return $this->managedBy;
    }

    /**
     * Debit order start date. Cannot be a date in the past.
     *
     * @param  string $startDate
     * @return $this
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * Debit order start date. Cannot be a date in the past.
     *
     * @return  string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Debit order account is anonymous or otherwise
     *
     * @param  string $anonymousUser
     * @return $this
     */
    public function setAnonymousUser($anonymousUser)
    {
        $this->anonymousUser = $anonymousUser;
        return $this;
    }

    /**
     * Debit order account is anonymous or otherwise
     *
     * @return  string
     */
    public function getAnonymousUser()
    {
        return $this->anonymousUser;
    }

    /**
     * Frequencies of Debit Order
     * Valid values: [MONTHLY, BI_MONTHLY, WEEKLY, DAILY, ANNUALLY]
     *
     * @param  string $frequency
     * @return $this
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
        return $this;
    }

    /**
     * Frequencies of Debit Order
     * Valid values: [MONTHLY, BI_MONTHLY, WEEKLY, DAILY, ANNUALLY]
     *
     * @return  string
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Day on which Debit Order should be processed.
     * Valid values: [WEEKLY, LAST_DAY_OF_MONTH]
     *
     * @param  string $deductionDay
     * @return $this
     */
    public function setDeductionDay($deductionDay)
    {
        $this->deductionDay = $deductionDay;
        return $this;
    }

    /**
     * Day on which Debit Order should be processed.
     * Valid values: [WEEKLY, LAST_DAY_OF_MONTH]
     *
     * @return  string
     */
    public function getDeductionDay()
    {
        return $this->deductionDay;
    }

    /**
     * Call center representative Id. Must be set to one of the IDs specified in the merchant config
     * `callcenter.allowed.reps` list. If there are no IDs in the `callcenter.allowed.reps` list the
     * callCenterRepId can be an empty string.
     *
     * @param  array $callCenterRepId
     * @return $this
     */
    public function setCallCenterRepIds($callCenterRepId)
    {
        $this->callCenterRepId = $callCenterRepId;
        return $this;
    }

    /**
     * Call center representative Id. Must be set to one of the IDs specified in the merchant config
     * `callcenter.allowed.reps` list. If there are no IDs in the `callcenter.allowed.reps` list the
     * callCenterRepId can be an empty string.
     *
     * @return  array
     */
    public function getCallCenterRepIds()
    {
        return $this->callCenterRepId;
    }

    /**
     * Token representing the debit order setup.
     *
     * @param  array $recurringPaymentToken
     * @return $this
     */
    public function setRecurringPaymentToken($recurringPaymentToken)
    {
        $this->recurringPaymentToken = $recurringPaymentToken;
        return $this;
    }

    /**
     * Token representing the debit order setup.
     *
     * @return  array
     */
    public function getRecurringPaymentToken()
    {
        return $this->recurringPaymentToken;
    }
}
