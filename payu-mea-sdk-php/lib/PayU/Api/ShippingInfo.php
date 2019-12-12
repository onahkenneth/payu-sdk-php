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
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string business_name
 * @property string phone
 * @property string method
 * @property \PayU\Api\ShippingAddress shipping_address
 * @property \PayU\Api\ShippingCost shipping_cost
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
     * The invoice recipient first name. Maximum length is 30 characters.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * The invoice recipient last name. Maximum length is 30 characters.
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
     * The invoice recipient last name. Maximum length is 30 characters.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
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
     * @param string $business_name
     *
     * @return $this
     */
    public function setBusinessName($business_name)
    {
        $this->business_name = $business_name;
        return $this;
    }

    /**
     * The invoice recipient company business name. Maximum length is 100 characters.
     *
     * @return string
     */
    public function getBusinessName()
    {
        return $this->business_name;
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
     * @param \PayU\Api\ShippingAddress $shipping_address
     *
     * @return $this
     */
    public function setShippingAddress($shipping_address)
    {
        $this->shipping_address = $shipping_address;
        return $this;
    }

    /**
     * Shipping address of the recipient.
     *
     * @return \PayU\Api\ShippingAddress
     */
    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    /**
     * Shipping cost associated with the shipping option chosen by the customer.
     *
     * @param \PayU\Api\ShippingCost $shipping_cost
     *
     * @return $this
     */
    public function setShippingCost($shipping_cost)
    {
        $this->shipping_cost = $shipping_cost;
        return $this;
    }

    /**
     * Shipping cost associated with the shipping option chosen by the customer.
     *
     * @return \PayU\Api\ShippingCost
     */
    public function getShippingCost()
    {
        return $this->shipping_cost;
    }
}
