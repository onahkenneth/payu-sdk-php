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

use PayU\Exception\ConfigurationException;

/**
 * class Config
 *
 * Http Configuration Class
 *
 * @package PayU\Http
 */
class Config
{
    const HEADER_SEPARATOR = ';';

    /**
     * Some default options for SOAPClient
     * These are typically overridden by ConnectionManager
     *
     * @var array
     */
    public $defaultSoapClientOptions = array(
        'cache_wsdl' => WSDL_CACHE_BOTH,
        'connection_timeout' => 500000,
        //'cache_ttl' => 86400,
        'trace' => true,
        'exceptions' => true,
        'keep_alive' => false,
        'ssl_method' => SOAP_SSL_METHOD_SSLv23
    );

    private $headers = array();

    private $soapOptions;

    private $endpointUrl;

    private $method;

    /***
     * Number of times to retry a failed HTTP call
     */
    private $retryCount = 0;

    /**
     * Default Constructor
     *
     * @param string $url
     * @param string $method SOAP method (doTransaction, setTransaction etc) default doTransaction
     * @param array $configs All Configurations
     */
    public function __construct($url = null, $method = 'doTransaction', $configs = array())
    {
        $this->endpointUrl = $url;
        $this->method = $method;
        $this->soapOptions = $this->getHttpConstantsFromConfigs($configs, 'http.') + $this->defaultSoapClientOptions;
    }

    /**
     * Retrieves an array of constant key, and value based on Prefix
     *
     * @param array $configs configuration options
     * @param string $prefix HTTP configuration prefix
     * @return array
     */
    public function getHttpConstantsFromConfigs($configs = array(), $prefix)
    {
        $arr = array();
        if ($prefix != null && is_array($configs)) {
            foreach ($configs as $k => $v) {
                // Check if it startsWith
                if (substr($k, 0, strlen($prefix)) === $prefix) {
                    $newKey = ltrim($k, $prefix);
                    if (defined($newKey)) {
                        $arr[constant($newKey)] = $v;
                    }
                }
            }
        }
        return $arr;
    }

    /**
     * Gets Url endpoint
     *
     * @return null|string
     */
    public function getEndpointUrl()
    {
        return $this->endpointUrl;
    }

    /**
     * Sets Url endpoint
     *
     * @param $url
     */
    public function setEndpointUrl($endpointUrl)
    {
        $this->endpointUrl = $endpointUrl;
    }

    /**
     * Gets Method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Gets all Headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set Headers
     *
     * @param array $headers
     */
    public function setHeaders(array $headers = array())
    {
        $this->headers = $headers;
    }

    /**
     * Get Header by Name
     *
     * @param $name
     * @return string|null
     */
    public function getHeader($name)
    {
        if (array_key_exists($name, $this->headers)) {
            return $this->headers[$name];
        }
        return null;
    }

    /**
     * Adds a Header
     *
     * @param      $name
     * @param      $value
     * @param bool $overWrite allows you to override header value
     */
    public function addHeader($name, $value, $overWrite = true)
    {
        if (!array_key_exists($name, $this->headers) || $overWrite) {
            $this->headers[$name] = $value;
        } else {
            $this->headers[$name] = $this->headers[$name] . self::HEADER_SEPARATOR . $value;
        }
    }

    /**
     * Removes a Header
     *
     * @param $name
     */
    public function removeHeader($name)
    {
        unset($this->headers[$name]);
    }

    /**
     * Gets all curl options
     *
     * @return array
     */
    public function getSoapOptions()
    {
        return $this->soapOptions;
    }

    /**
     * Set SOAP Options. Overrides all SOAP options
     *
     * @param $options
     */
    public function setSoapOptions($options)
    {
        $this->curlOptions = $options;
    }

    /**
     * Add SOAP Option
     *
     * @param string $name
     * @param mixed $value
     */
    public function addSoapOption($name, $value)
    {
        $this->soapOptions[$name] = $value;
    }

    /**
     * Removes a SOAP option from the list
     *
     * @param $name
     */
    public function removeSoapOption($name)
    {
        unset($this->soapOptions[$name]);
    }

    /**
     * Sets the UserAgent string on the HTTP request
     *
     * @param string $userAgentString
     */
    public function setUserAgent($userAgentString)
    {
        $this->soapOptions['user_agent'] = $userAgentString;
    }

    /**
     * Set ssl parameters for certificate based client authentication
     *
     * @param      $certPath
     * @param null $passPhrase
     */
    public function setSSLCert($certPath, $passPhrase = null)
    {
        $this->soapOptions['local_cert'] = realpath($certPath);
        if (isset($passPhrase) && trim($passPhrase) != "") {
            $this->soapOptions['passphrase'] = $passPhrase;
        }
    }

    /**
     * Set HTTP proxy information
     *
     * @param string $proxy format http://[username:password]@hostname[:port]
     * @throws ConfigurationException
     */
    public function setHttpProxy($proxy)
    {
        $urlParts = parse_url($proxy);
        if ($urlParts == false || !array_key_exists("host", $urlParts)) {
            throw new ConfigurationException("Invalid proxy configuration " . $proxy);
        }
        $this->soapOptions['proxy_host'] = $urlParts["host"];
        if (isset($urlParts["port"])) {
            $this->soapOptions['proxy_port'] = $urlParts["port"];
        }
        if (isset($urlParts["user"])) {
            $this->soapOptions['proxy_login'] = $urlParts["user"];
            $this->soapOptions['proxy_password'] = $urlParts["pass"];
        }
    }

    /**
     * Set Http Retry Counts
     *
     * @param int $retryCount
     */
    public function setHttpRetryCount($retryCount)
    {
        $this->retryCount = $retryCount;
    }

    /**
     * Get Http Retry Counts
     *
     * @return int
     */
    public function getHttpRetryCount()
    {
        return $this->retryCount;
    }
}
