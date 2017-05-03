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
 * Class ShippingInfo
 *
 * Shipping information for the invoice recipient.
 *
 * @package PayU\Api
 *
 * @property string id
 * @property string firstName
 * @property string lastName
 * @property string email
 * @property string businessName
 * @property string phone
 * @property string method
 * @property \PayU\Api\ShippingAddress shippingAddress
 * @property \PayU\Api\ShippingCost shippingCost
 */
class ShippingInfo extends PayUModel
{
    /**
     * The shipping id.
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
     * The shipping id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * The invoice recipient first name. Maximum length is 30 characters.
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
     * The invoice recipient first name. Maximum length is 30 characters.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * The invoice recipient last name. Maximum length is 30 characters.
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
     * The invoice recipient last name. Maximum length is 30 characters.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * The invoice recipient email.
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
     * The invoice recipient email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * The invoice recipient company business name. Maximum length is 100 characters.
     *
     * @param string $businessName
     *
     * @return $this
     */
    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;
        return $this;
    }

    /**
     * The invoice recipient company business name. Maximum length is 100 characters.
     *
     * @return string
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }

    /**
     * Phone number of recipient
     *
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Phone number of recipient
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Shipping method
     *
     * @see https://help.payu.co.za/display/developers/Fraud+Prevention+Service for valid codes
     *
     * @param string $method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * Shipping method
     *
     * @see https://help.payu.co.za/display/developers/Fraud+Prevention+Service for valid codes
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Shipping address of the recipient.
     *
     * @param \PayU\Api\ShippingAddress $shippingAddress
     *
     * @return $this
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    /**
     * Shipping address of the recipient.
     *
     * @return \PayU\Api\ShippingAddress
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * Shipping cost associated with the shipping option chosen by the customer.
     *
     * @param \PayU\Api\ShippingCost $shippingCost
     *
     * @return $this
     */
    public function setShippingCost($shippingCost)
    {
        $this->shippingCost = $shippingCost;
        return $this;
    }

    /**
     * Shipping cost associated with the shipping option chosen by the customer.
     *
     * @return \PayU\Api\ShippingCost
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }
}
