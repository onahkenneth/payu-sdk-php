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

use PayU\Conversion\Formatter;
use PayU\Model\PayUModel;
use PayU\Validation\NumericValidator;

/**
 * Class Details
 *
 * Additional details of the payment amount.
 *
 * @package PayU\Api
 *
 * @property string subtotal
 * @property string shipping
 * @property string tax
 * @property string handling_fee
 * @property string shipping_discount
 * @property string insurance
 * @property string gift_wrap
 * @property string fee
 */
class Details extends PayUModel
{
    /**
     * Amount of the subtotal of the items. **Required** if line items are specified.
     * 10 characters max, with support for integers.
     *
     * @param string|double $subtotal
     *
     * @return $this
     */
    public function setSubtotal($subtotal)
    {
        NumericValidator::validate($subtotal, "Subtotal");
        $subtotal = Formatter::formatToPrice($subtotal);
        $this->subtotal = $subtotal;
        return $this;
    }

    /**
     * Amount of the subtotal of the items. **Required** if line items are specified.
     * 10 characters max, with support for integers.
     *
     * @return string
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Amount charged for shipping.
     *
     * @param string|double $shipping
     *
     * @return $this
     */
    public function setShipping($shipping)
    {
        NumericValidator::validate($shipping, "Shipping");
        $shipping = Formatter::formatToPrice($shipping);
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * Amount charged for shipping.
     *
     * @return string
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Amount charged for tax.
     *
     * @param string|double $tax
     *
     * @return $this
     */
    public function setTax($tax)
    {
        NumericValidator::validate($tax, "Tax");
        $tax = Formatter::formatToPrice($tax);
        $this->tax = $tax;
        return $this;
    }

    /**
     * Amount charged for tax.
     *
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Amount being charged for the handling fee.
     *
     * @param string|double $handling_fee
     *
     * @return $this
     */
    public function setHandlingFee($handling_fee)
    {
        NumericValidator::validate($handling_fee, "Handling Fee");
        $handling_fee = Formatter::formatToPrice($handling_fee);
        $this->handling_fee = $handling_fee;
        return $this;
    }

    /**
     * Amount being charged for the handling fee.
     *
     * @return string
     */
    public function getHandlingFee()
    {
        return $this->handling_fee;
    }

    /**
     * Amount being discounted for the shipping fee.
     *
     * @param string|double $shipping_discount
     *
     * @return $this
     */
    public function setShippingDiscount($shipping_discount)
    {
        NumericValidator::validate($shipping_discount, "Shipping Discount");
        $shipping_discount = Formatter::formatToPrice($shipping_discount);
        $this->shipping_discount = $shipping_discount;
        return $this;
    }

    /**
     * Amount being discounted for the shipping fee.
     *
     * @return string
     */
    public function getShippingDiscount()
    {
        return $this->shipping_discount;
    }

    /**
     * Amount being charged as gift wrap fee.
     *
     * @param string|double $gift_wrap
     *
     * @return $this
     */
    public function setGiftWrap($gift_wrap)
    {
        NumericValidator::validate($gift_wrap, "Gift Wrap");
        $gift_wrap = Formatter::formatToPrice($gift_wrap);
        $this->gift_wrap = $gift_wrap;
        return $this;
    }

    /**
     * Amount being charged as gift wrap fee.
     *
     * @return string
     */
    public function getGiftWrap()
    {
        return $this->gift_wrap;
    }

    /**
     * Fee charged by PayU. In case of a refund,
     * this is the fee amount refunded to the original recipient of the payment.
     *
     * @param string|double $fee
     *
     * @return $this
     */
    public function setFee($fee)
    {
        NumericValidator::validate($fee, "Fee");
        $fee = Formatter::formatToPrice($fee);
        $this->fee = $fee;
        return $this;
    }

    /**
     * Fee charged by PayU. In case of a refund,
     * this is the fee amount refunded to the original recipient of the payment.
     *
     * @return string
     */
    public function getFee()
    {
        return $this->fee;
    }
}
