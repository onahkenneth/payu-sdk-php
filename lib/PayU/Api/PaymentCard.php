<?php
/**
 * PayU PHP SDK Library
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
 * Class PaymentCard
 *
 * A payment card that can fund a payment.
 *
 * @package PayU\Api
 *
 * @property string id
 * @property string number
 * @property string type
 * @property string expireMonth
 * @property string expireYear
 * @property string startMonth
 * @property string startYear
 * @property string cvv2
 * @property string firstName
 * @property string lastName
 * @property string billingCountry
 * @property \PayU\Api\BillingAddress billingAddress
 * @property string status
 * @property string issueNumber
 * @property boolean showBudget
 * @property boolean secure3D
 */
class PaymentCard extends PayUModel
{
    const TYPE_VISA = 'VISA';
    const TYPE_MASTERCARD = 'MASTERCARD';
    const TYPE_MAESTRO = 'MAESTRO';

    /**
     * The ID of a credit card to save for later use.
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * The ID of a credit card to save for later use.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * The card number.
     *
     * @param string $number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * The card number.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * The card type.
     * Valid Values: ["VISA", "DISCOVERY", "MAESTRO",  "MASTERCARD"]
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * The card type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * The two-digit expiry month for the card.
     *
     * @param string $expireMonth
     *
     * @return $this
     */
    public function setExpireMonth($expireMonth)
    {
        $this->expireMonth = $expireMonth;
        return $this;
    }

    /**
     * The two-digit expiry month for the card.
     *
     * @return string
     */
    public function getExpireMonth()
    {
        return $this->expireMonth;
    }

    /**
     * The four-digit expiry year for the card.
     *
     * @param string $expireYear
     *
     * @return $this
     */
    public function setExpireYear($expireYear)
    {
        $this->expireYear = $expireYear;
        return $this;
    }

    /**
     * The four-digit expiry year for the card.
     *
     * @return string
     */
    public function getExpireYear()
    {
        return $this->expireYear;
    }

    /**
     * The two-digit start month.
     *
     * @param string $startMonth
     *
     * @return $this
     */
    public function setStartMonth($startMonth)
    {
        $this->startMonth = $startMonth;
        return $this;
    }

    /**
     * The two-digit start month.
     *
     * @return string
     */
    public function getStartMonth()
    {
        return $this->startMonth;
    }

    /**
     * The four-digit expiry year.
     *
     * @param string $startYear
     *
     * @return $this
     */
    public function setStartYear($startYear)
    {
        $this->startYear = $startYear;
        return $this;
    }

    /**
     * The four-digit expiry year.
     *
     * @return string
     */
    public function getStartYear()
    {
        return $this->startYear;
    }

    /**
     * The validation code for the card. Supported for payments but not for saving payment cards for future use.
     *
     * @param string $cvv2
     *
     * @return $this
     */
    public function setCvv2($cvv2)
    {
        $this->cvv2 = $cvv2;
        return $this;
    }

    /**
     * The validation code for the card. Supported for payments but not for saving payment cards for future use.
     *
     * @return string
     */
    public function getCvv2()
    {
        return $this->cvv2;
    }

    /**
     * The first name of the card holder.
     *
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * The first name of the card holder.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * The last name of the card holder.
     *
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Alias function to concatenate 'firstName' and 'lastName' properties.
     *
     * @return string
     */
    public function getNameOnCard()
    {
        return $this->firstName . ' ' . $this->getLastName();
    }

    /**
     * The last name of the card holder.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * The two-letter country code.
     *
     * @param string $billingCountry
     *
     * @return $this
     */
    public function setBillingCountry($billingCountry)
    {
        $this->billingCountry = $billingCountry;
        return $this;
    }

    /**
     * The two-letter country code.
     *
     * @return string
     */
    public function getBillingCountry()
    {
        return $this->billingCountry;
    }

    /**
     * The billing address for the card.
     *
     * @param \PayU\Api\BillingAddress $billingAddress
     *
     * @return $this
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * The billing address for the card.
     *
     * @return \PayU\Api\BillingAddress
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * The issue number.
     *
     * @param string $issueNumber
     *
     * @return $this
     */
    public function setIssueNumber($issueNumber)
    {
        $this->issueNumber = $issueNumber;
        return $this;
    }

    /**
     * The issue number.
     *
     * @return string
     */
    public function getIssueNumber()
    {
        return $this->issueNumber;
    }

    /**
     * The state of the funding instrument.
     * Valid Values: ["EXPIRED", "ACTIVE"]
     *
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * The state of the funding instrument.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Alias for when card is valid i.e concatenate expireMonth and expireYear.
     *
     * @return string
     */
    public function getValidUntil()
    {
        return $this->expireMonth . $this->expireYear;
    }

    /**
     * The flag provides for budget payment.
     *
     * @param string $showBudget
     *
     * @return $this
     */
    public function setShowBudget($showBudget)
    {
        $this->showBudget = $showBudget;
        return $this;
    }

    /**
     * The flag provides for budget payment.
     *
     * @return string
     */
    public function getShowBudget()
    {
        return $this->showBudget;
    }

    /**
     * Secure 3D authentication. For some charge back risk reduction.
     *
     * @param string $secure3D
     *
     * @return $this
     */
    public function setSecure3D($secure3D)
    {
        $this->secure3D = $secure3D;
        return $this;
    }

    /**
     * Secure 3D authentication. For some charge back risk reduction.
     *
     * @return string
     */
    public function getSecure3D()
    {
        return $this->secure3D;
    }
}
