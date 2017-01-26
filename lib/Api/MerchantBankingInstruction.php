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
 * Class RecipientBankingInstruction
 *
 * Recipient bank Details.
 *
 * @package PayU\Api
 *
 * @property string bank_name
 * @property string account_holder_name
 * @property string account_number
 * @property string routing_number
 * @property string international_bank_account_number
 * @property string bank_identifier_code
 */
class MerchantBankingInstruction extends PayUModel
{
    /**
     * Name of the financial institution.
     *
     * @param string $bank_name
     *
     * @return $this
     */
    public function setBankName($bank_name)
    {
        $this->bank_name = $bank_name;
        return $this;
    }

    /**
     * Name of the financial institution.
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->bank_name;
    }

    /**
     * Name of the account holder
     *
     * @param string $account_holder_name
     *
     * @return $this
     */
    public function setAccountHolderName($account_holder_name)
    {
        $this->account_holder_name = $account_holder_name;
        return $this;
    }

    /**
     * Name of the account holder
     *
     * @return string
     */
    public function getAccountHolderName()
    {
        return $this->account_holder_name;
    }

    /**
     * bank account number
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
     * bank account number
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->account_number;
    }

    /**
     * bank routing number
     *
     * @param string $routing_number
     *
     * @return $this
     */
    public function setRoutingNumber($routing_number)
    {
        $this->routing_number = $routing_number;
        return $this;
    }

    /**
     * bank routing number
     *
     * @return string
     */
    public function getRoutingNumber()
    {
        return $this->routing_number;
    }

    /**
     * IBAN equivalent of the bank
     *
     * @param string $international_bank_account_number
     *
     * @return $this
     */
    public function setInternationalBankAccountNumber($international_bank_account_number)
    {
        $this->international_bank_account_number = $international_bank_account_number;
        return $this;
    }

    /**
     * IBAN equivalent of the bank
     *
     * @return string
     */
    public function getInternationalBankAccountNumber()
    {
        return $this->international_bank_account_number;
    }

    /**
     * BIC identifier of the financial institution
     *
     * @param string $bank_identifier_code
     *
     * @return $this
     */
    public function setBankIdentifierCode($bank_identifier_code)
    {
        $this->bank_identifier_code = $bank_identifier_code;
        return $this;
    }

    /**
     * BIC identifier of the financial institution
     *
     * @return string
     */
    public function getBankIdentifierCode()
    {
        return $this->bank_identifier_code;
    }
}
