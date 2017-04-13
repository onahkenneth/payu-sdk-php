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
 * Class Secure3D
 *
 * @package PayU\Api
 *
 * @property string secure3DId
 * @property string secure3DUrl
 */
class Secure3D extends PayUModel
{
    /**
     * Secure3D Id
     *
     * @param $secure3DId
     *
     * @return $this
     */
    public function setSecure3DId($secure3DId)
    {
        $this->secure3DId = $secure3DId;
        return $this;
    }

    /**
     * Secure3D Id
     *
     * @return string
     */
    public function getSecure3DId()
    {
        return $this->secure3DId;
    }

    /**
     * Secure3D Url
     *
     * @param $secure3DUrl
     *
     * @return $this
     */
    public function setSecure3DUrl($secure3DUrl)
    {
        $this->secure3DUrl = $secure3DUrl;
        return $this;
    }

    /**
     * Secure3D Url
     *
     * @return string
     */
    public function getSecure3DUrl()
    {
        return $this->secure3DUrl;
    }
}

