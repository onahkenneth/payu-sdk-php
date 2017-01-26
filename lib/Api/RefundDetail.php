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
 * Class RefundDetail
 *
 * Invoicing refund information.
 *
 * @package PayU\Api
 *
 * @property string transaction_id
 * @property string date
 * @property string note
 * @property \PayU\Api\Currency amount
 */
class RefundDetail extends PayUModel
{
    /**
     * The PayU refund transaction ID.
     *
     * @param string $transaction_id
     *
     * @return $this
     */
    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;
        return $this;
    }

    /**
     * The PayU refund transaction ID.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * Date on which the invoice was refunded. Date format: yyyy-MM-dd z. For example, 2014-02-27 PST.
     *
     * @param string $date
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Date on which the invoice was refunded. Date format: yyyy-MM-dd z. For example, 2014-02-27 PST.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Optional note associated with the refund.
     *
     * @param string $note
     *
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * Optional note associated with the refund.
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Amount to be recorded as refund against invoice. If this field is not passed,
     * the total invoice paid amount is recorded as refund.
     *
     * @param \PayU\Api\Currency $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Amount to be recorded as refund against invoice. If this field is not passed,
     * the total invoice paid amount is recorded as refund.
     *
     * @return \PayU\Api\Currency
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
