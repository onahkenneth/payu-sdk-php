<?php

namespace PayU\HttpClient;

use PayU\ResponseError;
use PayU\Exception\PayUException;
use PayU\Exception\ServerException;
use PayU\Exception\NetworkException;
use PayU\Exception\AuthorizationException;
use PayU\Exception\ConfigurationException;
use PayU\Exception\ServerMaintenanceException;
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
class Client
{

    /**
     * @param string $pathUrl
     * @param string $data
     * @param AuthenticationType $authType
     * @return mixed
     * @throws ConfigurationException
     * @throws NetworkException
     */
    public static function doPost($pathUrl, $data, $authType)
    {
        $response = CurlClient::doRequest('POST', $pathUrl, $authType, $data);

        return $response;
    }

    /**
     * @param string $pathUrl
     * @param AuthenticationType $authType
     * @return mixed
     * @throws ConfigurationException
     * @throws NetworkException
     */
    public static function doGet($pathUrl, $authType)
    {
        $response = CurlClient::doRequest('GET', $pathUrl, $authType);

        return $response;
    }

    /**
     * @param string $pathUrl
     * @param AuthenticationType $authType
     * @return mixed
     * @throws ConfigurationException
     * @throws NetworkException
     */
    public static function doDelete($pathUrl, $authType)
    {
        $response = CurlClient::doRequest('DELETE', $pathUrl, $authType);

        return $response;
    }

    /**
     * @param string $pathUrl
     * @param string $data
     * @param AuthenticationType $authType
     * @return mixed
     * @throws ConfigurationException
     * @throws NetworkException
     */
    public static function doPut($pathUrl, $data, $authType)
    {
        $response = CurlClient::doRequest('PUT', $pathUrl, $authType, $data);

        return $response;
    }

    /**
     * @param $statusCode
     * @param null $message
     * @throws PayUException
     * @throws AuthorizationException
     * @throws NetworkException
     * @throws ServerMaintenanceException
     * @throws ServerException
     */
    public static function throwHttpStatusException($statusCode, $message = null)
    {

        $response = $message->getResponse();
        $statusDesc = ($response->status && $response->status->statusDesc) ? $response->status->statusDesc : '';

        switch ($statusCode) {
            case 400:
                throw new PayUException($message->getStatus() . ' - ' . $statusDesc, $statusCode);
                break;

            case 401:
            case 403:
                throw new AuthorizationException($message->getStatus() . ' - ' . $statusDesc, $statusCode);
                break;

            case 404:
                throw new NetworkException($message->getStatus() . ' - ' . $statusDesc, $statusCode);
                break;

            case 408:
                throw new ServerException('Request timeout', $statusCode);
                break;

            case 500:
                throw new ServerException('PayU system is unavailable or your order is not processed. Error: [' . $statusDesc . ']', $statusCode);
                break;

            case 503:
                throw new ServerMaintenanceException('Service unavailable', $statusCode);
                break;

            default:
                throw new NetworkException('Unexpected HTTP code response', $statusCode);
                break;

        }
    }

    /**
     * @param $statusCode
     * @param ResponseError $resultError
     * @throws \Exception
     * @throws AuthorizationException
     * @throws NetworkException
     * @throws ServerException
     * @throws ServerMaintenanceException
     */
    public static function throwErrorHttpStatusException($statusCode, $resultError)
    {
        switch ($statusCode) {
            case 400:
                throw new \Exception($resultError->getError().' - '.$resultError->getErrorDescription(), $statusCode);
                break;

            case 401:
            case 403:
                throw new AuthorizationException($resultError->getError().' - '.$resultError->getErrorDescription(), $statusCode);
                break;

            case 404:
                throw new NetworkException($resultError->getError().' - '.$resultError->getErrorDescription(), $statusCode);
                break;

            case 408:
                throw new ServerException('Request timeout', $statusCode);
                break;

            case 500:
                throw new ServerException('PayU system is unavailable. Error: [' . $resultError->getErrorDescription() . ']', $resultError);
                break;

            case 503:
                throw new ServerMaintenanceException('Service unavailable', $statusCode);
                break;

            default:
                throw new NetworkException('Unexpected HTTP code response', $statusCode);
                break;

        }
    }
}
