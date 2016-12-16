<?php

namespace PayU\Auth;

/**
 * PayU PHP SDK Library
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
use PayU\Exception\ConfigurationException;

/**
 * @var string
 */
class BasicAuth
{
    private $authBasicToken;

    public function __construct($apiUsername, $apiPassword)
    {
        if (empty($apiUsername)) {
            throw new ConfigurationException('API username is empty');
        }

        if (empty($apiPassword)) {
            throw new ConfigurationException('API password is empty');
        }

        $this->authBasicToken = base64_encode($apiUsername . ':' . $apiPassword);
    }

    public function getHeaders()
    {
        return array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . $this->authBasicToken
        );
    }
}
