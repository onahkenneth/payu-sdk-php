<?php

namespace PayU;

/**
 * Class PayU
 *
 * @package PayU
 */
class PayU
{
    // @var string The PayU Safe key to be used for requests.
    public static $safeKey;

    // @var string The PayU API Username to be used for requests.
    public static $apiUsername;

    // @var string The PayU API Password to be used for requests.
    public static $apiPassword;

    // @var string The base URL for the PayU API.
    public static $apiBase = 'https://secure.payu.co.za';

    // @var string|null The version of the PayU API to use for requests.
    public static $apiVersion = 'ONE_ZERO';

    // @var string|null The account ID for connected accounts requests.
    public static $accountId = null;

    // @var boolean Defaults to true.
    public static $verifySslCerts = true;

    // @var array The application's information (name, version, URL)
    public static $appInfo = null;

    const VERSION = '1.0.0';

    /**
     * @return string The Safe key used for requests.
     */
    public static function getSafeKey()
    {
        return self::$safeKey;
    }

    /**
     * Sets the Safe key to be used for requests.
     *
     * @param string $safeKey
     */
    public static function setSafeKey($safeKey)
    {
        self::$safeKey = $safeKey;
    }

    /**
     * @return string The API username used for requests.
     */
    public static function getApiUsername()
    {
        return self::$apiUsername;
    }

    /**
     * Sets the API username to be used for requests.
     *
     * @param string $apiUsername
     */
    public static function setApiUsername($apiUsername)
    {
        self::$apiUsername = $apiUsername;
    }

    /**
     * @return string The API password used for requests.
     */
    public static function getApiPassword()
    {
        return self::$apiPassword;
    }

    /**
     * Sets the API password to be used for requests.
     *
     * @param string $apiPassword
     */
    public static function setApiPassword($apiPassword)
    {
        self::$apiPassword = $apiPassword;
    }

    /**
     * @return string The API version used for requests. null if we're using the
     *    latest version.
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }

    /**
     * @param string $apiVersion The API version to use for requests.
     */
    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
    }

    /**
     * @return boolean
     */
    public static function getVerifySslCerts()
    {
        return self::$verifySslCerts;
    }

    /**
     * @param boolean $verify
     */
    public static function setVerifySslCerts($verify)
    {
        self::$verifySslCerts = $verify;
    }

    /**
     * @return string | null The PayU account ID for connected account
     *   requests.
     */
    public static function getAccountId()
    {
        return self::$accountId;
    }

    /**
     * @param string $accountId The PayU account ID to set for connected
     *   account requests.
     */
    public static function setAccountId($accountId)
    {
        self::$accountId = $accountId;
    }

    /**
     * @return array | null The application's information
     */
    public static function getAppInfo()
    {
        return self::$appInfo;
    }

    /**
     * @param string $appName The application's name
     * @param string $appVersion The application's version
     * @param string $appUrl The application's URL
     */
    public static function setAppInfo($appName, $appVersion = null, $appUrl = null)
    {
        if (self::$appInfo === null) {
            self::$appInfo = array();
        }
        self::$appInfo['name'] = $appName;
        self::$appInfo['version'] = $appVersion;
        self::$appInfo['url'] = $appUrl;
    }
}
