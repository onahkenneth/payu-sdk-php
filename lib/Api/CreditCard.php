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

use PayU\Model\ResourceModel;

/**
 * Class CreditCard
 *
 * @package    PayU\Api
 *
 * @property string number
 * @property string type
 * @property int expire_month
 * @property int expire_year
 * @property string cvv2
 * @property string first_name
 * @property string last_name
 * @property \PayU\Api\Address billing_address
 * @property string external_customer_id
 * @property string state
 * @property string valid_until
 */
class CreditCard extends ResourceModel
{
    /**
     * ID of the credit card. This ID is provided in the response when storing credit cards. **Required if using a stored credit card.**
     *
     * @deprecated Not publicly available
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
     * ID of the credit card. This ID is provided in the response when storing credit cards.
     * *Required if using a stored credit card.**
     *
     * @deprecated Not publicly available
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Credit card number. Numeric characters only with no spaces or punctuation.
     * The string must conform with modulo and length required by each credit card type. *Redacted in responses.*
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
     * Credit card number. Numeric characters only with no spaces or punctuation.
     * The string must conform with modulo and length required by each credit card type. *Redacted in responses.*
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Credit card type. Valid types are: `visa`, `mastercard`
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
     * Credit card type. Valid types are: `visa`, `mastercard`
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Expiration month with no leading zero. Acceptable values are 1 through 12.
     *
     * @param int $expire_month
     *
     * @return $this
     */
    public function setExpireMonth($expire_month)
    {
        $this->expire_month = $expire_month;
        return $this;
    }

    /**
     * Expiration month with no leading zero. Acceptable values are 1 through 12.
     *
     * @return int
     */
    public function getExpireMonth()
    {
        return $this->expire_month;
    }

    /**
     * 4-digit expiration year.
     *
     * @param int $expire_year
     *
     * @return $this
     */
    public function setExpireYear($expire_year)
    {
        $this->expire_year = $expire_year;
        return $this;
    }

    /**
     * 4-digit expiration year.
     *
     * @return int
     */
    public function getExpireYear()
    {
        return $this->expire_year;
    }

    /**
     * 3-4 digit card validation code.
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
     * 3-4 digit card validation code.
     *
     * @return string
     */
    public function getCvv2()
    {
        return $this->cvv2;
    }

    /**
     * Cardholder's first name.
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
     * Cardholder's first name.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Cardholder's last name.
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
     * Cardholder's last name.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Billing Address associated with this card.
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
     * Billing Address associated with this card.
     *
     * @return \PayU\Api\Address
     */
    public function getBillingAddress()
    {
        return $this->billing_address;
    }

    /**
     * A unique identifier of the customer to whom this bank account belongs.
     * Generated and provided by the facilitator.
     *
     * @param string $external_customer_id
     *
     * @return $this
     */
    public function setExternalCustomerId($external_customer_id)
    {
        $this->external_customer_id = $external_customer_id;
        return $this;
    }

    /**
     * A unique identifier of the customer to whom this bank account belongs.
     * Generated and provided by the facilitator.
     *
     * @return string
     */
    public function getExternalCustomerId()
    {
        return $this->external_customer_id;
    }

    /**
     * State of the credit card funding instrument.
     * Valid Values: ["expired", "ok"]
     *
     * @param string $state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * State of the credit card funding instrument.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Funding instrument expiration date.
     *
     * @param string $create_time
     *
     * @return $this
     */
    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;
        return $this;
    }

    /**
     * Resource creation time  as ISO8601 date-time format (ex: 1994-11-05T13:15:30Z) that indicates creation time.
     *
     * @return string
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Resource creation time  as ISO8601 date-time format (ex: 1994-11-05T13:15:30Z) that indicates the updation time.
     *
     * @param string $update_time
     *
     * @return $this
     */
    public function setUpdateTime($update_time)
    {
        $this->update_time = $update_time;
        return $this;
    }

    /**
     * Resource creation time  as ISO8601 date-time format (ex: 1994-11-05T13:15:30Z) that indicates the updation time.
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Date/Time until this resource can be used fund a payment.
     *
     * @param string $valid_until
     *
     * @return $this
     */
    public function setValidUntil($valid_until)
    {
        $this->valid_until = $valid_until;
        return $this;
    }

    /**
     * Funding instrument expiration date.
     *
     * @return string
     */
    public function getValidUntil()
    {
        return $this->valid_until;
    }
}
