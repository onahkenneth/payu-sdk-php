<?php

namespace PayU;

use PayU\Exception\PayUConfigurationException;

/**
 * PayU PHP SDK Library
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class PayUConfiguration
{
    
    const API_VERSION = '1.0';
    const COMPOSER_JSON = "/composer.json";
    const DEFAULT_SDK_VERSION = 'PHP SDK 1.0.0';

    private static $env = 'secure';
    private static $safeKey = '';
    private static $apiUsername = '';
    private static $apiPassword = '';
    private static $serviceUrl = '';
    private static $hashAlgorithm = 'SHA-256';

    private static $_availableEnvironment = array('secure', 'staging');
    private static $_availableHashAlgorithm = array('SHA', 'SHA-256', 'SHA-384', 'SHA-512');

    /**
     * @return string
     */
    public static function getApiVersion()
    {
        return self::API_VERSION;
    }

    /**
     * @param string
     * @throws PayUConfigurationException
     */
    public static function setSafeKey($safeKey)
    {
        if (empty($safeKey)) {
            throw new PayUConfigurationException('Safe key cannot be empty');
        }

        self::$safeKey = $safeKey;
    }

    /**
     * @return string
     */
    public static function getSafeKey()
    {
        return self::$safeKey;
    }

    /**
     * @param string
     * @throws PayUConfigurationException
     */
    public static function setApiUsername($apiUsername)
    {
        if (empty($apiUsername)) {
            throw new PayUConfigurationException('API username cannot be empty');
        }

        self::$apiUsername = $apiUsername;
    }

    /**
     * @return string
     */
    public static function getApiUsername()
    {
        return self::$apiUsername;
    }

    /**
     * @param string
     * @throws PayUConfigurationException
     */
    public static function setApiPassword($apiPassword)
    {
        if (empty($apiPassword)) {
            throw new PayUConfigurationException('API password cannot be empty');
        }

        self::$apiPassword = $apiPassword;
    }

    /**
     * @return string
     */
    public static function getApiPassword()
    {
        return self::$apiPassword;
    }

    /**
     * @param string
     * @throws OpenPayU_Exception_Configuration
     */
    public static function setHashAlgorithm($value)
    {
        if (!in_array($value, self::$_availableHashAlgorithm)) {
            throw new PayUConfigurationException('Hash algorithm "' . $value . '"" is not available');
        }

        self::$hashAlgorithm = $value;
    }

    /**
     * @return string
     */
    public static function getHashAlgorithm()
    {
        return self::$hashAlgorithm;
    }

    /**
     * @param string $environment
     * @param string $domain
     * @param string $api
     * @param string $version
     * @throws OpenPayU_Exception_Configuration
     */
    public static function setEnvironment($environment = 'secure', $domain = 'payu.co.za', $api = 'service/PayUAPI')
    {
        $environment = strtolower($environment);
        $domain = strtolower($domain) . '/';

        if (!in_array($environment, self::$_availableEnvironment)) {
            throw new PayUConfigurationException($environment . ' - is not valid environment');
        }

        self::$env = $environment;
        self::$serviceUrl = 'https://' . $environment . '.' . $domain . $api;
    }

    /**
     * @return string
     */
    public static function getEnvironment()
    {
        return self::$env;
    }

    /**
     * @return string
     */
    public static function getServiceUrl()
    {
        return self::$serviceUrl;
    }

    /**
     * @return string
     */
    public static function getSdkVersion()
    {
        $composerFilePath = self::getComposerFilePath();
        if (file_exists($composerFilePath)) {
            $fileContent = file_get_contents($composerFilePath);
            $composerData = json_decode($fileContent);
            if (isset($composerData->version) && isset($composerData->extra[0]->engine)) {
                return sprintf("%s %s", $composerData->extra[0]->engine, $composerData->version);
            }
        }

        return self::DEFAULT_SDK_VERSION;
    }

    /**
     * @return string
     */
    private static function getComposerFilePath()
    {
        return realpath(dirname(__FILE__)) . '/../' . self::COMPOSER_JSON;
    }
}
