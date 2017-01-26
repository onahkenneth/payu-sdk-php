<?php

namespace PayU\Model;

use PayU\Resource;
use PayU\Soap\ApiContext;
use PayU\Transport\RestCall;
use PayU\Transport\SoapCall;

/**
 * Class ResourceModel
 *
 * An executable ResourceModel class
 *
 * @package PayU\Model
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class ResourceModel extends PayUModel implements Resource
{
    /**
     * Execute SDK Call to PayU services
     *
     * @param string $url
     * @param string $method
     * @param string $payLoad
     * @param array $headers
     * @param ApiContext $apiContext
     * @param RestCall $restCall
     * @param array $handlers
     * @return string json response of the object
     */
    protected static function executeCall(
        $url,
        $method,
        $payLoad,
        $headers = array(),
        $apiContext = null,
        $soapCall = null,
        $handlers = array('PayU\Handler\BasicAuthHandler')
    )
    {
        //Initialize the context and rest call object if not provided explicitly
        $apiContext = $apiContext ? $apiContext : new ApiContext(self::$credential);
        $soapCall = $soapCall ? $soapCall : new SoapCall($apiContext);

        //Make the execution call
        $json = $soapCall->execute($handlers, $url, $method, $payLoad, $headers);
        return $json;
    }

    /**
     * Updates Access Token using long lived refresh token
     *
     * @param string|null $refreshToken
     * @param ApiContext $apiContext
     * @return void
     */
    public function updateAccessToken($refreshToken, $apiContext)
    {
        $apiContext = $apiContext ? $apiContext : new ApiContext(self::$credential);
        $apiContext->getCredential()->updateAccessToken($apiContext->getConfig(), $refreshToken);
    }
}
