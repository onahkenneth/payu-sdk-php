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
 * @property boolean showBudget
 * @property \PayU\Api\TransactionRecord $transactionRecord
 * @property \PayU\Api\FmDetails fraudManagement
 * @property \PayU\Api\ShippingInfo shippingInfo
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
     * @var \PayU\Api\TransactionRecord $transactionRecord
     * @return $this
     */
    public function setTransactionRecord($transactionRecord)
    {
        $this->transactionRecord = $transactionRecord;
        return $this;
    }

    /**
     * Debit order transaction record
     *
     * @return \PayU\Api\TransactionRecord $transactionRecord
     */
    public function getTransactionRecord()
    {
        return $this->transactionRecord;
    }

    /**
     * Fraud management
     *
     * @var \PayU\Api\FmDetails $fraudManagement
     * @return $this
     */
    public function setFraudManagement($fraudManagement)
    {
        $this->fraudManagement = $fraudManagement;
        return $this;
    }

    /**
     * Fraud management
     *
     * @return \PayU\Api\FmDetails $fraudManagement
     */
    public function getFraudManagement()
    {
        return $this->fraudManagement;
    }

    /**
     * Shipping information
     *
     * @var \PayU\Api\ShippingInfo $shippingInfo
     * @return $this
     */
    public function setShippingInfo($shippingInfo)
    {
        $this->shippingInfo = $shippingInfo;
        return $this;
    }

    /**
     * Shipping information
     *
     * @return \PayU\Api\ShippingInfo $shippingInfo
     */
    public function getShippingInfo()
    {
        return $this->shippingInfo;
    }

    /**
     * The showBudget flag provides for budget payment.
     *
     * @param string $showBudget
     *
     * @return $this
     */
    public function setShowBudget($showBudget)
    {
        $this->showBudget = $showBudget;
        return $this;
    }

    /**
     * The showBudget flag provides for budget payment.
     *
     * @return string
     */
    public function getShowBudget()
    {
        return $this->showBudget;
    }
}
