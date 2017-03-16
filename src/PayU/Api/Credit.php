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

/**
 * Class Credit
 *
 * A resource representing a credit instrument.
 *
 * @package PayU\Api
 *
 * @property string id
 * @property string type
 */
class Credit
{
    /**
     * Unique identifier of credit resource.
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
     * Unique identifier of credit resource.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * specifies type of credit
     * Valid Values: ["MASATERCARD", "VISA"]
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * specifies type of credit
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
