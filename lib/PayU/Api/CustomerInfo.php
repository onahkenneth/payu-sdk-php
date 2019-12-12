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
 * Class CustomerInfo
 *
 * A resource representing a information about Customer.
 *
 * @package PayU\Api
 *
 * @property string email
 * @property string accountNumber
 * @property string firstName
 * @property string lastName
 * @property string customerId
 * @property string phone
 * @property string countryCode
 * @property string countryOfResidence
 * @property Address billingAddress
 */
class CustomerInfo extends PayUModel
{
    /**
     * Email address representing the customer. 127 characters max.
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Email address representing the customer. 127 characters max.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Account Number representing the Customer
     *
     * @param string $accountNumber
     *
     * @return $this
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * Account Number representing the Customer
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * First name of the customer.
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
     * First name of the customer.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Last name of the payer.
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
     * Last name of the payer.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }


    /**
     * PayU assigned ID.
     *
     * @param string $customerId
     *
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * PayU assigned ID.
     *
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Phone number representing the Customer 20 characters max.
     *
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Phone number representing the Customer. 20 characters max.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Registered phone country code of the customer.
     * @see https://countrycode.org
     *
     * @param string $countryCode
     *
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * Registered phone country code of the customer.
     * @see https://countrycode.org
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Two-letter registered country of residence code of the customer.
     * @see https://countrycode.org
     *
     * @param string $countryOfResidence
     *
     * @return $this
     */
    public function setCountryOfResidence($countryOfResidence)
    {
        $this->countryOfResidence = $countryOfResidence;
        return $this;
    }

    /**
     * Two-letter registered country of residence code of the customer.
     * @see https://countrycode.org
     *
     * @return string
     */
    public function getCountryOfResidence()
    {
        return $this->countryOfResidence;
    }

    /**
     * Billing address of the Customer.
     *
     * @param Address $billingAddress
     *
     * @return $this
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * Billing address of the Customer.
     *
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }
}
