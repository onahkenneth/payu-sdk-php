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

namespace PayU\Http;

use PayU\Core\LoggingManager;
use PayU\Exception\ConfigurationException;
use PayU\Exception\NetworkException;
use PayU\Soap\ApiContext;

/**
 * class SoapConnection
 *
 *
 * @package PayU\Http
 */
class SoapConnection implements ConnectionInterface
{
    /**
     * HTTP status codes for which a retry must be attempted
     * retry is currently attempted for Request timeout, Bad Gateway,
     * Service Unavailable and Gateway timeout errors.
     */
    private static $retryCodes = array('408', '502', '503', '504',);

    /**
     * @var ApiContext
     */
    private $apiContext;

    /**
     * @var Config
     */
    private $httpConfig;
    /**
     * LoggingManager
     *
     * @var LoggingManager
     */
    private $logger;

    /**
     * Default Constructor
     *
     * @param Config $httpConfig
     * @throws ConfigurationException
     */
    public function __construct(ApiContext $apiContext, Config $httpConfig)
    {
        if (!extension_loaded("soap")) {
            throw new ConfigurationException("SOAP extension is not available/enabled on the server");
        }

        $this->apiContext = $apiContext;
        $this->httpConfig = $httpConfig;
        $this->logger = LoggingManager::getInstance(__CLASS__);
    }

    /**
     * Executes an HTTP request
     *
     * @param string $methodName SOAP method to call
     * @param string $data POST content as a string
     * @return mixed
     * @throws NetworkException
     */
    public function execute($methodName, $data)
    {
        $apiContext = $this->apiContext;
        $httpConfig = $this->httpConfig;

        //Initialize the logger
        if ($apiContext->get('log.log_enabled') === true)
            $this->logger->debug($httpConfig->getMethod() . ' ' . $httpConfig->getEndpointUrl());

        //Initialize client
        $soapClient = new PayUSoapClient($apiContext, $httpConfig);
        $headers = $this->getHttpHeaders();

        //Logging Each Headers for debugging purposes
        foreach ($headers as $header) {
            //TODO: Strip out credentials and other secure info when logging.
            $this->logger->debug($header);
        }

        $payload = array_merge(array(
            'Api' => PayUSoapClient::API_VERSION,
            'Safekey' => $apiContext->getCredential()->getSafekey(),
        ), $data);

        $result = $soapClient->doAction($methodName, $payload, $headers);

        if ($apiContext->get('log.log_enabled') === true)
            $this->logger->debug($soapClient->debugLog());

        return $result;

        /*
        //Retrieve Response Status
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //Retry if Certificate Exception
        if (curl_errno($ch) == 60) {
            $this->logger->info("Invalid or no certificate authority found - Retrying using bundled CA certs file");
            curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
            $result = curl_exec($ch);
            //Retrieve Response Status
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }

        //Retry if Failing
        $retries = 0;
        if (in_array($httpStatus, self::$retryCodes) && $this->httpConfig->getHttpRetryCount() != null) {
            $this->logger->info("Got $httpStatus response from server. Retrying");
            do {
                $result = curl_exec($ch);
                //Retrieve Response Status
                $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            } while (in_array($httpStatus, self::$retryCodes) && (++$retries < $this->httpConfig->getHttpRetryCount()));
        }

        //Throw Exception if Retries and Certificates doenst work
        if (curl_errno($ch)) {
            $ex = new NetworkException(
                $this->httpConfig->getUrl(),
                curl_error($ch),
                curl_errno($ch)
            );
            curl_close($ch);
            throw $ex;
        }

        // Get Request and Response Headers
        $requestHeaders = curl_getinfo($ch, CURLINFO_HEADER_OUT);
        //Using alternative solution to CURLINFO_HEADER_SIZE as it throws invalid number when called using PROXY.
        if (function_exists('mb_strlen')) {
            $responseHeaderSize = mb_strlen($result, '8bit') - curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
            $responseHeaders = mb_substr($result, 0, $responseHeaderSize, '8bit');
            $result = mb_substr($result, $responseHeaderSize, mb_strlen($result), '8bit');
        } else {
            $responseHeaderSize = strlen($result) - curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
            $responseHeaders = substr($result, 0, $responseHeaderSize);
            $result = substr($result, $responseHeaderSize);
        }

        $this->logger->debug("Request Headers \t: " . str_replace("\r\n", ", ", $requestHeaders));
        $this->logger->debug(($data && $data != '' ? "Request Data\t\t: " . $data : "No Request Payload") . "\n" . str_repeat('-', 128) . "\n");
        $this->logger->info("Response Status \t: " . $httpStatus);
        $this->logger->debug("Response Headers\t: " . str_replace("\r\n", ", ", $responseHeaders));

        //Close the curl request
        curl_close($ch);

        //More Exceptions based on HttpStatus Code
        if (in_array($httpStatus, self::$retryCodes)) {
            $ex = new NetworkException(
                $this->httpConfig->getUrl(),
                "Got Http response code $httpStatus when accessing {$this->httpConfig->getUrl()}. " .
                "Retried $retries times."
            );
            $ex->setData($result);
            $this->logger->error("Got Http response code $httpStatus when accessing {$this->httpConfig->getUrl()}. " .
                "Retried $retries times." . $result);
            $this->logger->debug("\n\n" . str_repeat('=', 128) . "\n");
            throw $ex;
        } elseif ($httpStatus < 200 || $httpStatus >= 300) {
            $ex = new NetworkException(
                $this->httpConfig->getUrl(),
                "Got Http response code $httpStatus when accessing {$this->httpConfig->getUrl()}.",
                $httpStatus
            );
            $ex->setData($result);
            $this->logger->error("Got Http response code $httpStatus when accessing {$this->httpConfig->getUrl()}. " . $result);
            $this->logger->debug("\n\n" . str_repeat('=', 128) . "\n");
            throw $ex;
        }

        $this->logger->debug(($result && $result != '' ? "Response Data \t: " . $result : "No Response Body") . "\n\n" . str_repeat('=', 128) . "\n");

        //Return result object
        return $result;
        */
    }

    /**
     * Gets all Http Headers
     *
     * @return array
     */
    private function getHttpHeaders()
    {
        $ret = array();
        foreach ($this->httpConfig->getHeaders() as $k => $v) {
            $ret[] = "$k: $v";
        }
        return $ret;
    }
}
