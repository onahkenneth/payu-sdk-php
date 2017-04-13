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
 * @property string account_number
 * @property string salutation
 * @property string first_name
 * @property string middle_name
 * @property string last_name
 * @property string suffix
 * @property string customer_id
 * @property string phone
 * @property string birth_date
 * @property string country_code
 * @property string country_of_residence
 * @property \PayU\Api\Address billing_address
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
     * @param string $account_number
     *
     * @return $this
     */
    public function setAccountNumber($account_number)
    {
        $this->account_number = $account_number;
        return $this;
    }

    /**
     * Account Number representing the Customer
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->account_number;
    }

    /**
     * Salutation of the customer.
     *
     * @param string $salutation
     *
     * @return $this
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;
        return $this;
    }

    /**
     * Salutation of the customer.
     *
     * @return string
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * First name of the customer.
     *
     * @param string $first_name
     *
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * First name of the customer.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Middle name of the customer.
     *
     * @param string $middle_name
     *
     * @return $this
     */
    public function setMiddleName($middle_name)
    {
        $this->middle_name = $middle_name;
        return $this;
    }

    /**
     * Middle name of the customer.
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middle_name;
    }

    /**
     * Last name of the payer.
     *
     * @param string $last_name
     *
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * Last name of the payer.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Suffix of the payer.
     *
     * @param string $suffix
     *
     * @return $this
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * Suffix of the payer.
     *
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * PayU assigned ID.
     *
     * @param string $customer_id
     *
     * @return $this
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
        return $this;
    }

    /**
     * PayU assigned ID.
     *
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customer_id;
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
     * Birth date of the Customer in ISO8601 format (yyyy-mm-dd).
     *
     * @param string $birth_date
     *
     * @return $this
     */
    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;
        return $this;
    }

    /**
     * Birth date of the Customer in ISO8601 format (yyyy-mm-dd).
     *
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * Registered country code of the customer.
     * @see https://countrycode.org
     *
     * @param string $country_code
     *
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
        return $this;
    }

    /**
     * Registered country code of the customer.
     * @see https://countrycode.org
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Two-letter registered country of residence code of the customer.
     * @see https://countrycode.org
     *
     * @param string $country_of_residence
     *
     * @return $this
     */
    public function setCountryOfResidence($country_of_residence)
    {
        $this->country_of_residence = $country_of_residence;
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
        return $this->country_of_residence;
    }

    /**
     * Billing address of the Customer.
     *
     * @param \PayU\Api\Address $billing_address
     *
     * @return $this
     */
    public function setBillingAddress($billing_address)
    {
        $this->billing_address = $billing_address;
        return $this;
    }

    /**
     * Billing address of the Customer.
     *
     * @return \PayU\Api\Address
     */
    public function getBillingAddress()
    {
        return $this->billing_address;
    }
}
