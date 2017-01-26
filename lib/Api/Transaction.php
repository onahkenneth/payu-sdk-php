<?php
/**
 * PayU EMEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

/**
 * Class Transaction
 *
 * A transaction defines the contract of a payment - what is the payment
 * for and who is fulfilling it.
 *
 * @package PaU\Api
 *
 */
class Transaction extends TransactionBase
{
    const STATE_NEW = 'NEW';
    const STATE_PROCESSING = 'PROCESSING';
    const STATE_TIMEOUT = 'TIMEOUT';
    const STATE_FAILED = 'FAILED';
    const STATE_EXPIRED = 'EXPIRED';
    const STATE_SUCCESSFUL = 'SUCCESSFUL';
    const STATE_AWAITING_PAYMENT = 'AWAITING_PAYMENT';

    const TYPE_PAYMENT = 'payment'; // means a sale
    const TYPE_RESERVE = 'reserve'; // means authorize payment
    const TYPE_CREDIT = 'credit'; // means a refund
    const TYPE_FINALIZE = 'finalize'; // means capture an authorized payment
    const TYPE_RESERVE_CANCEL = 'reserve_cancel'; // means reverse an authorization

    /**
     * Additional transactions for complex payment scenarios.
     *
     *
     * @param self $transactions
     *
     * @return $this
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
        return $this;
    }

    /**
     * Additional transactions for complex payment scenarios.
     *
     * @return self[]
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
}
