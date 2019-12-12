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

/**
 * Class TransactionBase
 *
 * A transaction defines the contract of a payment - what is the payment for and who is fulfilling it.
 *
 * @package PayU\Api
 *
 * @property boolean show_budget
 * @property \PayU\Api\TransactionRecord $transaction_record
 * @property \PayU\Api\FmDetails fraud_management
 * @property \PayU\Api\ShippingInfo shipping_info
 */
class TransactionBase extends CartBase
{
    const STATE_NEW = 'NEW';
    const STATE_PROCESSING = 'PROCESSING';
    const STATE_TIMEOUT = 'TIMEOUT';
    const STATE_FAILED = 'FAILED';
    const STATE_EXPIRED = 'EXPIRED';
    const STATE_SUCCESSFUL = 'SUCCESSFUL';
    const STATE_AWAITING_PAYMENT = 'AWAITING_PAYMENT';

    const TYPE_PAYMENT = 'PAYMENT'; // means a sale
    const TYPE_RESERVE = 'RESERVE'; // means authorize payment
    const TYPE_CREDIT = 'CREDIT'; // means a refund
    const TYPE_FINALIZE = 'FINALIZE'; // means capture an authorized payment
    const TYPE_RESERVE_CANCEL = 'RESERVE_CANCEL'; // means reverse an authorization
    const TYPE_DEBIT_ORDER = 'DEBIT_ORDER';
    const TYPE_ONCE_OFF_PAYMENT_AND_DEBIT_ORDER = 'ONCE_OFF_PAYMENT_AND_DEBIT_ORDER'; // debit order with payment
    const TYPE_ONCE_OFF_RESERVE_AND_DEBIT_ORDER = 'ONCE_OFF_RESERVE_AND_DEBIT_ORDER'; // debit order with reserve

    /**
     * Debit order transaction record
     *
     * @var \PayU\Api\TransactionRecord $transaction_record
     * @return $this
     */
    public function setTransactionRecord($transaction_record)
    {
        $this->transaction_record = $transaction_record;
        return $this;
    }

    /**
     * Debit order transaction record
     *
     * @return \PayU\Api\TransactionRecord $transaction_record
     */
    public function getTransactionRecord()
    {
        return $this->transaction_record;
    }

    /**
     * Fraud management
     *
     * @var \PayU\Api\FmDetails $fraud_management
     * @return $this
     */
    public function setFraudManagement($fraud_management)
    {
        $this->fraud_management = $fraud_management;
        return $this;
    }

    /**
     * Fraud management
     *
     * @return \PayU\Api\FmDetails $fraud_management
     */
    public function getFraudManagement()
    {
        return $this->fraud_management;
    }

    /**
     * Shipping information
     *
     * @var \PayU\Api\ShippingInfo $shipping_info
     * @return $this
     */
    public function setShippingInfo($shipping_info)
    {
        $this->shipping_info = $shipping_info;
        return $this;
    }

    /**
     * Shipping information
     *
     * @return \PayU\Api\ShippingInfo $shipping_info
     */
    public function getShippingInfo()
    {
        return $this->shipping_info;
    }

    /**
     * The show_budget flag provides for budget payment.
     *
     * @param string $show_budget
     *
     * @return $this
     */
    public function setShowBudget($show_budget)
    {
        $this->show_budget = $show_budget;
        return $this;
    }

    /**
     * The show_budget flag provides for budget payment.
     *
     * @return string
     */
    public function getShowBudget()
    {
        return $this->show_budget;
    }
}
