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
 * Class CartBase
 *
 * Base properties of a cart resource
 *
 * @package PayU\Api
 *
 * @property string referenceId
 * @property \PayU\Api\Amount amount
 * @property \PayU\Api\Merchant merchant
 * @property string description
 * @property string invoiceNumber
 * @property \PayU\Api\ItemList itemList
 */
class CartBase extends PayUModel
{
    /**
     * Merchant identifier to the purchase unit. Optional parameter
     *
     * @param string $referenceId
     *
     * @return $this
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    /**
     * Merchant identifier to the purchase unit. Optional parameter
     *
     * @return string
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * Amount being collected.
     *
     * @param \PayU\Api\Amount $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Amount being collected.
     *
     * @return \PayU\Api\Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Recipient of the funds in this transaction.
     *
     * @param \PayU\Api\Merchant $merchant
     *
     * @return $this
     */
    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
        return $this;
    }

    /**
     * Recipient of the funds in this transaction.
     *
     * @return \PayU\Api\Merchant
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * Description of what is being paid for.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Description of what is being paid for.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * free-form field for the use of clients
     *
     * @param string $custom
     *
     * @return $this
     */
    public function setCustom($custom)
    {
        $this->custom = $custom;
        return $this;
    }

    /**
     * free-form field for the use of clients
     *
     * @return string
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * invoice number to track this payment
     *
     * @param string $invoiceNumber
     *
     * @return $this
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    /**
     * invoice number to track this payment
     *
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * List of items being paid for.
     *
     * @param \PayU\Api\ItemList $itemList
     *
     * @return $this
     */
    public function setItemList($itemList)
    {
        $this->itemList = $itemList;
        return $this;
    }

    /**
     * List of items being paid for.
     *
     * @return \PayU\Api\ItemList
     */
    public function getItemList()
    {
        return $this->itemList;
    }
}
