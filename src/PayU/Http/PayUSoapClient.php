<?php

namespace PayU\Http;

use PayU\Soap\ApiContext;

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
class PayUSoapClient
{
    const API_VERSION = 'ONE_ZERO';
    const PAYU_NAMESPACE = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';
    /**
     * @var \SoapClient
     */
    private static $soapClient;
    private $apiContext;
    private $httpConfig;
    private $streamContext;

    /**
     * PayUSoapClient constructor.
     *
     * @param ApiContext $apiContext
     * @param Config $httpConfig
     */
    public function __construct(ApiContext $apiContext, Config $httpConfig)
    {
        $this->apiContext = $apiContext;
        $this->httpConfig = $httpConfig;
        $this->streamContext = stream_context_create();

        // Create the stream_context and add it to the options
        $options = array_merge($httpConfig->getSoapOptions(), array('stream_context' => $this->streamContext));

        // Create new SOAP client
        if (null === self::$soapClient) {
            self::$soapClient = new \SoapClient($httpConfig->getEndpointUrl(), $options);
        }

        return $this;
    }

    /**
     * Execute SOAP method on the client
     *
     * @param string $methodName the soap call method to execute
     * @param string $payload the payment transaction details
     *
     * @return
     */
    public function doAction($methodName, $payload, $httpHeaders)
    {
        $this->setHttpHeader($httpHeaders);
        self::$soapClient->__setSoapHeaders($this->getAuthHeader());
        $response = self::$soapClient->$methodName($payload);

        return json_encode($response);
    }

    /**
     * Set HTTP headers passed to the request
     *
     * @param array $httpHeaders
     */
    private function setHttpHeader($httpHeaders)
    {
        stream_context_set_option($this->streamContext, array('http' => array('header' => $httpHeaders)));
    }

    /**
     * SOAP Authentication header for SOAP client
     *
     * @return \SOAPHeader
     */
    private function getAuthHeader()
    {
        $credential = $this->apiContext->getCredential();

        $header = '<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">';
        $header .= '<wsse:UsernameToken wsu:Id="UsernameToken-9" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">';
        $header .= '<wsse:Username>' . $credential->getUsername() . '</wsse:Username>';
        $header .= '<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">' . $credential->getPassword() . '</wsse:Password>';
        $header .= '</wsse:UsernameToken>';
        $header .= '</wsse:Security>';

        $headerbody = new \SoapVar($header, XSD_ANYXML, null, null, null);
        return new \SOAPHeader(self::PAYU_NAMESPACE, 'Security', $headerbody, true);
    }
}
