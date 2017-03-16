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
 * Class Item
 *
 * Item details.
 *
 * @package PayU\Api
 *
 * @property string sku
 * @property string name
 * @property string description
 * @property string quantity
 * @property string price
 * @property string currency
 * @property string tax
 */
class Item extends PayUModel
{
    /**
     * Stock keeping unit corresponding (SKU) to item.
     *
     * @param string $sku
     *
     * @return $this
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * Stock keeping unit corresponding (SKU) to item.
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Item name. 127 characters max.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Item name. 127 characters max.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Description of the item.
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
     * Description of the item.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Number of a particular item. 10 characters max.
     *
     * @param string $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Number of a particular item. 10 characters max.
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Item cost. 10 characters max.
     *
     * @param string|double $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        NumericValidator::validate($price, "Price");
        $price = Formatter::formatToPrice($price, $this->getCurrency());
        $this->price = $price;
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
     * Item cost. 10 characters max.
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

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
     * Tax of the item.
     *
     * @param string|double $tax
     *
     * @return $this
     */
    public function setTax($tax)
    {
        NumericValidator::validate($tax, "Tax");
        $tax = Formatter::formatToPrice($tax, $this->getCurrency());
        $this->tax = $tax;
        return $this;
    }

    /**
     * Tax of the item.
     *
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }
}
