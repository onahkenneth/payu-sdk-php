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

namespace PayU\Core;

use PayU\Auth\BasicAuth;
use PayU\Exception\InvalidCredentialException;

/**
 * class CredentialManager
 *
 * CredentialManager holds all the credential information in one place.
 *
 * @package PayU\Core
 */
class CredentialManager
{
    /**
     * Singleton Object
     *
     * @var CredentialManager
     */
    private static $instance;

    /**
     * Hashmap to contain credentials for accounts.
     *
     * @var array
     */
    private $credentialHashmap = array();

    /**
     * Contains the API username of the default account to use
     * when authenticating API calls
     *
     * @var string
     */
    private $defaultAccountName;

    /**
     * Constructor initialize credential for multiple accounts specified in property file
     *
     * @param $config
     * @throws \Exception
     */
    private function __construct($config)
    {
        try {
            $this->initCredential($config);
        } catch (\Exception $e) {
            $this->credentialHashmap = array();
            throw $e;
        }
    }

    /**
     * Load credentials for multiple accounts.
     *
     * @param array $config
     */
    private function initCredential($config)
    {
        $suffix = 1;
        $prefix = "acct";

        $arr = array();
        foreach ($config as $k => $v) {
            if (strstr($k, $prefix)) {
                $arr[$k] = $v;
            }
        }
        $credArr = $arr;

        $arr = array();
        foreach ($config as $key => $value) {
            $pos = strpos($key, '.');
            if (strstr($key, "acct")) {
                $arr[] = substr($key, 0, $pos);
            }
        }
        $arrayPartKeys = array_unique($arr);

        $key = $prefix . $suffix;
        $account = null;
        while (in_array($key, $arrayPartKeys)) {
            if (isset($credArr[$key . ".username"]) && isset($credArr[$key . ".password"]) && isset($credArr[$key . ".safekey"])) {
                $account = $key;
                $this->credentialHashmap[$account] = new BasicAuth(
                    $credArr[$key . ".username"],
                    $credArr[$key . ".password"],
                    $credArr[$key . ".safekey"]
                );
            }
            if ($account && $this->defaultAccountName == null) {
                if (array_key_exists($key . '.store_id', $credArr)) {
                    $this->defaultAccountName = $credArr[$key . '.store_id'];
                } else {
                    $this->defaultAccountName = $key;
                }
            }
            $suffix++;
            $key = $prefix . $suffix;
        }
    }

    /**
     * Create singleton instance for this class.
     *
     * @param array|null $config
     * @return CredentialManager
     */
    public static function getInstance($config = null)
    {
        if (!self::$instance) {
            self::$instance = new self($config == null ? ConfigManager::getInstance()->getConfigHashmap() : $config);
        }
        return self::$instance;
    }

    /**
     * Sets credential object for users
     *
     * @param \PayU\Auth\BasicAuth $credential
     * @param string|null $accountId Account Id associated with the account
     * @param bool $default If set, it would make it as a default credential for all requests
     *
     * @return $this
     */
    public function setCredentialObject(BasicAuth $credential, $accountId = null, $default = true)
    {
        $key = $accountId == null ? 'default' : $accountId;
        $this->credentialHashmap[$key] = $credential;
        if ($default) {
            $this->defaultAccountName = $key;
        }
        return $this;
    }

    /**
     * Obtain Credential Object based on StoreId provided.
     *
     * @param null $accountId
     * @return BasicAuth
     * @throws InvalidCredentialException
     */
    public function getCredentialObject($accountId = null)
    {
        if ($accountId == null && array_key_exists($this->defaultAccountName, $this->credentialHashmap)) {
            $credObj = $this->credentialHashmap[$this->defaultAccountName];
        } elseif (array_key_exists($accountId, $this->credentialHashmap)) {
            $credObj = $this->credentialHashmap[$accountId];
        }

        if (empty($credObj)) {
            throw new InvalidCredentialException("Credential not found for " . ($accountId ? $accountId : " default user") .
                ". Please make sure your configuration/APIContext has credential information");
        }
        return $credObj;
    }

    /**
     * Disabling __clone call
     */
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
