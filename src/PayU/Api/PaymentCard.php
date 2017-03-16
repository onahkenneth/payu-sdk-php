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
 * @property string expire_month
 * @property string expire_year
 * @property string start_month
 * @property string start_year
 * @property string cvv2
 * @property string first_name
 * @property string last_name
 * @property string billing_country
 * @property \PayU\Api\Address billing_address
 * @property string status
 * @property string card_product_class
 * @property string valid_until
 * @property string issue_number
 */
class PaymentCard extends PayUModel
{
    const TYPE_VISA = 'visa';
    const TYPE_MASTERCARD = 'mastercard';
    const TYPE_MAESTRO = 'maestro';

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
     * @param string $expire_month
     *
     * @return $this
     */
    public function setExpireMonth($expire_month)
    {
        $this->expire_month = $expire_month;
        return $this;
    }

    /**
     * The two-digit expiry month for the card.
     *
     * @return string
     */
    public function getExpireMonth()
    {
        return $this->expire_month;
    }

    /**
     * The four-digit expiry year for the card.
     *
     * @param string $expire_year
     *
     * @return $this
     */
    public function setExpireYear($expire_year)
    {
        $this->expire_year = $expire_year;
        return $this;
    }

    /**
     * The four-digit expiry year for the card.
     *
     * @return string
     */
    public function getExpireYear()
    {
        return $this->expire_year;
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
     * The first name of the card holder.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * The last name of the card holder.
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
     * The last name of the card holder.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * The two-letter country code.
     *
     * @param string $billing_country
     *
     * @return $this
     */
    public function setBillingCountry($billing_country)
    {
        $this->billing_country = $billing_country;
        return $this;
    }

    /**
     * The two-letter country code.
     *
     * @return string
     */
    public function getBillingCountry()
    {
        return $this->billing_country;
    }

    /**
     * The billing address for the card.
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
     * The billing address for the card.
     *
     * @return \PayU\Api\Address
     */
    public function getBillingAddress()
    {
        return $this->billing_address;
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
     * The product class of the financial instrument issuer.
     * Valid Values: ["CREDIT", "DEBIT", "PREPAID", "UNKNOWN"]
     *
     * @param string $card_product_class
     *
     * @return $this
     */
    public function setCardProductClass($card_product_class)
    {
        $this->card_product_class = $card_product_class;
        return $this;
    }

    /**
     * The product class of the financial instrument issuer.
     *
     * @return string
     */
    public function getCardProductClass()
    {
        return $this->card_product_class;
    }

    /**
     * The date and time until when this instrument can be used fund a payment.
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
     * The date and time until when this instrument can be used fund a payment.
     *
     * @return string
     */
    public function getValidUntil()
    {
        return $this->valid_until;
    }
}
