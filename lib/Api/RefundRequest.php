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
 * Class RefundRequest
 *
 * A refund transaction.
 *
 * @package PayU\Api
 *
 * @property \PayU\Api\Amount amount
 * @property string description
 * @property string refundSource
 * @property string reason
 * @property string invoiceNumber
 */
class RefundRequest extends PayUModel
{
    /**
     * Details including both refunded amount (to customer) and refunded fee (to merchant).
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
     * Details including both refunded amount (to customer) and refunded fee (to merchant).
     *
     * @return \PayU\Api\Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Description of what is being refunded for.
     * Character length and limitations: 255 single-byte alphanumeric characters.
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
     * Description of what is being refunded for.
     * Character length and limitations: 255 single-byte alphanumeric characters.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Type of PayU funding source (balance or eCheck) that can be used for auto refund.
     * Valid Values: ["INSTANT_FUNDING_SOURCE", "ECHECK", "UNRESTRICTED"]
     *
     * @param string $refundSource
     *
     * @return $this
     */
    public function setRefundSource($refundSource)
    {
        $this->refund_source = $refundSource;
        return $this;
    }

    /**
     * Type of PayU funding source (balance or eCheck) that can be used for auto refund.
     *
     * @return string
     */
    public function getRefundSource()
    {
        return $this->refundSource;
    }

    /**
     * Reason description for the Sale transaction being refunded.
     *
     * @param string $reason
     *
     * @return $this
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
        return $this;
    }

    /**
     * Reason description for the Sale transaction being refunded.
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * The invoice number that is used to track this payment. Character
     * length and limitations: 127 single-byte alphanumeric characters.
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
     * The invoice number that is used to track this payment. Character
     * length and limitations: 127 single-byte alphanumeric characters.
     *
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoice_number;
    }
}
