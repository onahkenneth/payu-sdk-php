<?php

namespace PayU\Http;

use PayU\Exception\AuthorizationException;
use PayU\Exception\NetworkException;
use PayU\Exception\PayUException;
use PayU\Exception\ServerException;
use PayU\Exception\ServerMaintenanceException;

/**
 * Class SoapClient
 *
 * @package PayU\Client
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class SoapClient
{
    protected $soapConnection;

    public function __construct(Config $httpConfig, array $config)
    {
        if (null == $this->soapConnection) {
            $this->soapConnection = new SoapConnection($httpConfig, $config);
        }
    }

    /**
     *
     * @param string $data
     */
    public function doPost($data)
    {
        $response = $this->soapConnection->execute($data);

        return $response;
    }

    /**
     *
     * @param string $data
     */
    public function doGet($data)
    {
        $response = $this->soapConnection->execute($data);

        return $response;
    }

    /**
     *
     * @param string $data
     */
    public function doDelete($data)
    {
        $response = $this->soapConnection->execute($data);

        return $response;
    }

    /**
     *
     * @param string $data
     */
    public function doPut($data)
    {
        $response = $this->soapConnection->execute($data);

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
    public function throwHttpStatusException($statusCode, $message = null)
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
     * @param \PayU\Api\ResponseError $resultError
     * @throws \Exception
     * @throws AuthorizationException
     * @throws NetworkException
     * @throws ServerException
     * @throws ServerMaintenanceException
     */
    public function throwErrorHttpStatusException($statusCode, $resultError)
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
