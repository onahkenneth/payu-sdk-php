<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Soap;

use PayU\Core\ConfigManager;
use PayU\Core\CredentialManager;

/**
 * Class ApiContext
 *
 * Call level parameters such as credentials, request-id etc
 *
 * @package PayU\Soap
 */
class ApiContext
{
    const ENTERPRISE = 'enterprise';
    const REDIRECT = 'redirect';

    /**
     * Unique request id to be used for this call
     * The user can either generate one as per application
     * needs or let the SDK generate one
     *
     * @var null|string $requestId
     */
    private $requestId;

    /**
     * This is a placeholder for holding credential for the request
     * If the value is not set, it would get the value from @\PayU\Core\CredentialManager
     *
     * @var \PayU\Auth\BasicAuth
     */
    private $credential;

    /**
     * Determines how to make API calls. Default integration method is Redirect Payment Page (RPP)
     *
     * @var string
     */
    private $integration;

    /**
     * PayU configuration Account Id placeholder. This enable multi-tenancy in the SDK, i.e multiple accounts can be
     * used within the SDK.
     *
     * @var string
     */
    private $accountId;


    /**
     * Construct
     *
     * @param \PayU\Auth\BasicAuth $basic_auth authentication for soap calls
     */
    public function __construct($basic_auth)
    {
        $this->credential = $basic_auth;
    }

    /**
     * Get Credential
     *
     * @return \PayU\Auth\BasicAuth
     */
    public function getCredential()
    {
        if (null == $this->credential) {
            return CredentialManager::getInstance()->getCredentialObject();
        }
        return $this->credential;
    }

    public function getRequestHeaders()
    {
        $result = ConfigManager::getInstance()->get('http.headers');
        $headers = array();
        foreach ($result as $header => $value) {
            $headerName = ltrim($header, 'http.headers');
            $headers[$headerName] = $value;
        }
        return $headers;
    }

    public function addRequestHeader($name, $value)
    {
        // Determine if the name already has a 'http.headers' prefix. If not, add one.
        if (!(substr($name, 0, strlen('http.headers')) === 'http.headers')) {
            $name = 'http.headers.' . $name;
        }
        ConfigManager::getInstance()->addConfigs(array($name => $value));
    }

    /**
     * Resets the requestId that can be used to set the PayU-request-id
     * header used for idempotency. In cases where you need to make multiple create calls
     * using the same ApiContext object, you need to reset request Id.
     *
     * @return string
     */
    public function resetRequestId()
    {
        $this->requestId = $this->generateRequestId();
        return $this->getRequestId();
    }

    /**
     * Generates a unique per request id that
     * can be used to set the PayU-Request-Id header
     * that is used for idempotency
     *
     * @return string
     */
    private function generateRequestId()
    {
        static $pid = -1;
        static $addr = -1;

        if ($pid == -1) {
            $pid = getmypid();
        }

        if ($addr == -1) {
            if (array_key_exists('SERVER_ADDR', $_SERVER)) {
                $addr = ip2long($_SERVER['SERVER_ADDR']);
            } else {
                $addr = php_uname('n');
            }
        }

        return $addr . $pid . $_SERVER['REQUEST_TIME'] . mt_rand(0, 0xffff);
    }

    /**
     * Get the Request ID
     *
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * Sets the request ID
     *
     * @param string $requestId the value to use
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
    }

    /**
     * Sets Config
     *
     * @param array $config SDK configuration parameters
     */
    public function setConfig(array $config)
    {
        ConfigManager::getInstance()->addConfigs($config);
    }

    /**
     * Gets Configurations hashmap
     *
     * @return array
     */
    public function getConfigHashmap()
    {
        return ConfigManager::getInstance()->getConfigHashmap();
    }

    /**
     * Gets a specific configuration from key
     *
     * @param $searchKey
     * @return mixed
     */
    public function get($searchKey)
    {
        return ConfigManager::getInstance()->get($searchKey);
    }

    /**
     * PayU configuration AccountId.
     *
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * PayU configuration AccountId.
     *
     * @param string $accountId
     *
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * API integration.
     *
     * Valid Values: ["enterprise", "redirect"]
     *
     * @return string
     */
    public function getIntegration()
    {
        return $this->integration;
    }

    /**
     * API integration.
     *
     * Valid Values: ["enterprise", "redirect"]
     *
     * @param string $integration
     *
     * @return $this
     */
    public function setIntegration($integration)
    {
        $this->integration = $integration;
        return $this;
    }
}
