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
 * Class Merchant
 *
 * A resource representing a Merchant who receives the funds and fulfills the order.
 *
 * @package PayU\Api
 *
 * @property string email
 * @property string merchantId
 * @property string firstName
 * @property string lastName
 * @property string accountNumber
 * @property Phone phone
 */
class Merchant extends PayUModel
{
    /**
     * Email Address associated with the Merchant's PayU Account.
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
     * Email Address associated with the Merchant's PayU Account.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * PayU account identifier for the Merchant.
     *
     * @param string $merchantId
     *
     * @return $this
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    /**
     * PayU account identifier for the Merchant.
     *
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * First Name of the Payee.
     *
     * @param string $first_name
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * First Name of the Payee.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Last Name of the Payee.
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
     * Last Name of the Payee.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * PayU account Number of the Merchant
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
     * PayU account Number of the Merchant
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Information related to the Payee.
     *
     * @param Phone $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Information related to the Merchant.
     *
     * @return Phone
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
