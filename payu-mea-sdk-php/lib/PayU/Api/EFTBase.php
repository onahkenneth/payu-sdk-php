<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Model\PayUModel;

/**
 * Class EFTBase
 *
 * Lets you create, process and manage EFT based payments.
 *
 * @package PayU\Api
 *
 * @property string amount
 * @property string method
 * @property string type
 * @property string url
 * @property string bankName
 */
class EFTBase extends PayUModel
{
    const FNB = 'FNB';
    const ABSA = 'ABSA';
    const NEDBANK = 'NEDBANK';
    const STANDARD_BANK = 'STANDARD_BANK';

    /**
     * Eft amounts to pay.
     *
     * @param string $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Eft amount to pay.
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Indicates the HTTP method that needs to be implemented, i.e. HTTP GET or HTTP POST
     *
     * @param string $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * Indicates the HTTP method that needs to be implemented, i.e. HTTP GET or HTTP POST
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Type of payment
     *
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Type of payment
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Redirect url. Customer is directed to a web page that provides a list of banks that accepts the
     * EFT Pro product as a payment method
     *
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Redirect url. Customer is directed to a web page that provides a list of banks that accepts the
     * EFT Pro product as a payment method
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Name of customer's bank
     *
     * @param string $bankName
     * @return $this
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
        return $this;
    }

    /**
     * Name of customer's bank
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }
}