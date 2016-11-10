<?php

namespace PayU\HttpClient;

use PayU\Authentication\AuthenticationType;

/**
 * PayU PHP SDK Library
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
interface ClientInterface
{
    /**
     * @param string $method The HTTP method being used
     * @param string $absUrl The URL being requested, including domain and protocol
     * @param AuthenticationType $auth
     * @param array $params key value pairs for parameters. Can be nested for arrays and hashes
     * @return array($httpStatusCode, $response)
     */
    public static function doRequest($method, $absUrl, $auth, $params);
}
