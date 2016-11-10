<?php

namespace PayU\HttpClient;

use PayU\Exception\NetworkException;
use PayU\Exception\ConfigurationException;
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
class CurlClient implements ClientInterface
{
    /**
     * @var
     */
    static $headers;

    /**
     * @param $requestType
     * @param $pathUrl
     * @param $data
     * @param AuthenticationType $auth
     * @return array
     * @throws ConfigurationException
     * @throws NetworkException
     */
    public static function doRequest($requestType, $pathUrl, $auth, $data = null)
    {
        if (empty($pathUrl)) {
            throw new ConfigurationException('The API endpoint is empty');
        }

        $ch = curl_init($pathUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $auth->getHeaders());
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, 'CurlClient::readHeader');
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($response === false) {
            throw new NetworkException(curl_error($ch));
        }
        curl_close($ch);

        return array('code' => $httpStatus, 'response' => trim($response));
    }

    /**
     * @param array $headers
     *
     * @return mixed
     */
    public function getSignature($headers)
    {
        foreach($headers as $name => $value)
        {
            if(preg_match('/X-PayU-Signature/i', $name) || preg_match('/PayU-Signature/i', $name))
                return $value;
        }

        return null;
    }

    /**
     * @param resource $ch
     * @param string $header
     * @return int
     */
    public static function readHeader($ch, $header)
    {
        if( preg_match('/([^:]+): (.+)/m', $header, $match) ) {
            self::$headers[$match[1]] = trim($match[2]);
        }

        return strlen($header);
    }
}

