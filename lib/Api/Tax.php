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
 * Class Tax
 *
 * Tax information.
 *
 * @package PayU\Api
 *
 * @property string id
 * @property string name
 * @property \PayU\Api\Number percent
 * @property \PayU\Api\Currency amount
 */
class Tax extends PayUModel
{
    /**
     * The resource ID.
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * The resource ID.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * The tax name. Maximum length is 20 characters.
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
     * The tax name. Maximum length is 20 characters.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The rate of the specified tax. Valid range is from 0.001 to 99.999.
     *
     * @param string|double $percent
     *
     * @return $this
     */
    public function setPercent($percent)
    {
        NumericValidator::validate($percent, "Percent");
        $percent = Formatter::formatToPrice($percent);
        $this->percent = $percent;
        return $this;
    }

    /**
     * The rate of the specified tax. Valid range is from 0.001 to 99.999.
     *
     * @return string
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * The tax as a monetary amount. Cannot be specified in a request.
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
     * The tax as a monetary amount. Cannot be specified in a request.
     *
     * @return \PayU\Api\Currency
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
