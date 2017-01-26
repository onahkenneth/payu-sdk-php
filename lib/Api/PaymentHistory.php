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
 * Class PaymentHistory
 *
 * List of Payments made by the seller.
 *
 * @package PayU\Api
 *
 * @property \PayU\Api\Payment[] payments
 * @property int count
 * @property string next_id
 */
class PaymentHistory extends PayUModel
{
    /**
     * Append Payments to the list.
     *
     * @param \PayU\Api\Payment $payment
     *
     * @return $this
     */
    public function addPayment($payment)
    {
        if (!$this->getPayments()) {
            return $this->setPayments(array($payment));
        } else {
            return $this->setPayments(
                array_merge($this->getPayments(), array($payment))
            );
        }
    }

    /**
     * A list of Payment resources
     *
     * @return \PayU\Api\Payment[]
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * A list of Payment resources
     *
     * @param \PayU\Api\Payment[] $payments
     *
     * @return $this
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;
        return $this;
    }

    /**
     * Remove Payments from the list.
     *
     * @param \PayU\Api\Payment $payment
     *
     * @return $this
     */
    public function removePayment($payment)
    {
        return $this->setPayments(
            array_diff($this->getPayments(), array($payment))
        );
    }

    /**
     * Number of items returned in each range of results. Note that the last results range could have fewer
     * items than the requested number of items. Maximum value: 20.
     *
     * @param int $count
     *
     * @return $this
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Number of items returned in each range of results. Note that the last results range could have fewer
     * items than the requested number of items. Maximum value: 20.
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Identifier of the next element to get the next range of results.
     *
     * @param string $next_id
     *
     * @return $this
     */
    public function setNextId($next_id)
    {
        $this->next_id = $next_id;
        return $this;
    }

    /**
     * Identifier of the next element to get the next range of results.
     *
     * @return string
     */
    public function getNextId()
    {
        return $this->next_id;
    }
}
