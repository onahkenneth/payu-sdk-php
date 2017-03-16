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

/**
 * Class DetailedRefund
 *
 * A refund transaction. This is the resource that is returned on GET
 *
 * @package PayU\Api
 *
 * @property string custom
 * @property \PayU\Api\Currency refund_to_payer
 * @property \PayU\Api\Currency refund_from_transaction_fee
 * @property \PayU\Api\Currency refund_from_received_amount
 * @property \PayU\Api\Currency total_refunded_amount
 */
class DetailedRefund extends Refund
{
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
     * Amount refunded to payer of the original transaction, in the current Refund call
     *
     * @param \PayU\Api\Currency $refund_to_payer
     *
     * @return $this
     */
    public function setRefundToPayer($refund_to_payer)
    {
        $this->refund_to_payer = $refund_to_payer;
        return $this;
    }

    /**
     * Amount refunded to payer of the original transaction, in the current Refund call
     *
     * @return \PayU\Api\Currency
     */
    public function getRefundToPayer()
    {
        return $this->refund_to_payer;
    }

    /**
     * Transaction fee refunded to original recipient of payment.
     *
     * @param \PayU\Api\Currency $refund_from_transaction_fee
     *
     * @return $this
     */
    public function setRefundFromTransactionFee($refund_from_transaction_fee)
    {
        $this->refund_from_transaction_fee = $refund_from_transaction_fee;
        return $this;
    }

    /**
     * Transaction fee refunded to original recipient of payment.
     *
     * @return \PayU\Api\Currency
     */
    public function getRefundFromTransactionFee()
    {
        return $this->refund_from_transaction_fee;
    }

    /**
     * Amount subtracted from PayU balance of the original recipient of payment, to make this refund.
     *
     * @param \PayU\Api\Currency $refund_from_received_amount
     *
     * @return $this
     */
    public function setRefundFromReceivedAmount($refund_from_received_amount)
    {
        $this->refund_from_received_amount = $refund_from_received_amount;
        return $this;
    }

    /**
     * Amount subtracted from PayU balance of the original recipient of payment, to make this refund.
     *
     * @return \PayU\Api\Currency
     */
    public function getRefundFromReceivedAmount()
    {
        return $this->refund_from_received_amount;
    }

    /**
     * Total amount refunded so far from the original purchase.
     * Say, for example, a buyer makes $100 purchase, the buyer
     * was refunded $20 a week ago and is refunded $30 in this transaction.
     * The gross refund amount is $30 (in this transaction). The total refunded amount is $50.
     *
     * @param \PayU\Api\Currency $total_refunded_amount
     *
     * @return $this
     */
    public function setTotalRefundedAmount($total_refunded_amount)
    {
        $this->total_refunded_amount = $total_refunded_amount;
        return $this;
    }

    /**
     * Total amount refunded so far from the original purchase.
     * Say, for example, a buyer makes $100 purchase, the buyer
     * was refunded $20 a week ago and is refunded $30 in this transaction.
     * The gross refund amount is $30 (in this transaction). The total refunded amount is $50.
     *
     * @return \PayU\Api\Currency
     */
    public function getTotalRefundedAmount()
    {
        return $this->total_refunded_amount;
    }
}
