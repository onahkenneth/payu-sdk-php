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

use PayU\Conversion\Formatter;
use PayU\Model\PayUModel;
use PayU\Validation\NumericValidator;

/**
 * Class Amount
 *
 * Payment amount.
 *
 * @package PayU\Api
 *
 * @property string currency
 * @property string total
 * @property \PayU\Api\Details details
 */
class Amount extends PayUModel
{
    /**
     * 3-letter [currency code].
     *
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Total amount charged from the payer to the payee. In case of a refund,
     * this is the refunded amount to the original payer from the payee.
     * 10 characters max with support for integers.
     *
     * @param string|double $total
     *
     * @return $this
     */
    public function setTotal($total)
    {
        NumericValidator::validate($total, "Total");
        $total = Formatter::formatToPrice($total, $this->getCurrency());
        $this->total = $total;
        return $this;
    }

    /**
     * 3-letter [currency code]
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Total amount charged from the payer to the payee. In case of a refund,
     * this is the refunded amount to the original payer from the payee.
     * 10 characters max with support for integers.
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Additional details of the payment amount.
     *
     * @param \PayU\Api\Details $details
     *
     * @return $this
     */
    public function setDetails($details)
    {
        $this->details = $details;
        return $this;
    }

    /**
     * Additional details of the payment amount.
     *
     * @return \PayU\Api\Details
     */
    public function getDetails()
    {
        return $this->details;
    }
}
