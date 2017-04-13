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

use PayU\Model\PayUModel;

/**
 * Class LookupDataEntry
 *
 * LookupDataEntry class contains lookup data key-value pair details,
 *
 * @package PayU\Api
 *
 * @property string key
 * @property \PayU\Api\Details value
 */
class LookupDataEntry extends PayUModel
{
    /**
     * string key
     *
     * @param string $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * string value
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * JSON string value
     *
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * JSON string value
     *
     * @return \PayU\Api\Details
     */
    public function getValue()
    {
        return $this->value;
    }
}