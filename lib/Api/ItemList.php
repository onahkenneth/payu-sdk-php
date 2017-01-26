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
 * Class ItemList
 *
 * List of items being paid for.
 *
 * @package PayU\Api
 *
 * @property \PayU\Api\Item[] items
 * @property \PayU\Api\ShippingAddress shipping_address
 * @property string shipping_method
 * @property string shipping_phone_number
 */
class ItemList extends PayUModel
{
    /**
     * Append Items to the list.
     *
     * @param \PayU\Api\Item $item
     *
     * @return $this
     */
    public function addItem($item)
    {
        if (!$this->getItems()) {
            return $this->setItems(array($item));
        } else {
            return $this->setItems(
                array_merge($this->getItems(), array($item))
            );
        }
    }

    /**
     * List of items.
     *
     * @return \PayU\Api\Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * List of items.
     *
     * @param \PayU\Api\Item[] $items
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * Remove Items from the list.
     *
     * @param \PayU\Api\Item $item
     *
     * @return $this
     */
    public function removeItem($item)
    {
        return $this->setItems(
            array_diff($this->getItems(), array($item))
        );
    }

    /**
     * Shipping address.
     *
     * @param \PayU\Api\ShippingAddress $shipping_address
     *
     * @return $this
     */
    public function setShippingAddress($shipping_address)
    {
        $this->shipping_address = $shipping_address;
        return $this;
    }

    /**
     * Shipping address.
     *
     * @return \PayU\Api\ShippingAddress
     */
    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    /**
     * Shipping method used for this payment like USPSParcel etc.
     *
     * @param string $shipping_method
     *
     * @return $this
     */
    public function setShippingMethod($shipping_method)
    {
        $this->shipping_method = $shipping_method;
        return $this;
    }

    /**
     * Shipping method used for this payment like USPSParcel etc.
     *
     * @return string
     */
    public function getShippingMethod()
    {
        return $this->shipping_method;
    }

    /**
     * Final contact number of payer associated with the transaction
     * might be same as shipping_phone_number or different. The phone
     * number must be represented in its canonical international format,
     * as defined by the E.164 numbering plan
     *
     * @param string $shipping_phone_number
     *
     * @return $this
     */
    public function setShippingPhoneNumber($shipping_phone_number)
    {
        $this->shipping_phone_number = $shipping_phone_number;
        return $this;
    }

    /**
     * Final contact number of payer associated with the transaction
     * might be same as shipping_phone_number or different. The phone
     * number must be represented in its canonical international format,
     * as defined by the E.164 numbering plan
     *
     * @return string
     */
    public function getShippingPhoneNumber()
    {
        return $this->shipping_phone_number;
    }
}
