<?php

namespace PayU\Core;

use PayU\Log\PayULogFactory;
use Psr\Log\LoggerInterface;

/**
 * Class LoggingManager
 *
 * Simple Logging Manager. This does an error_log for now
 *
 * @package PayU\Core
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class LoggingManager
{
    /**
     * @var array of logging manager instances with class name as key
     */
    private static $instances = array();

    /**
     * The logger to be used for all messages
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Logger Name
     *
     * @var string
     */
    private $loggerName;

    /**
     * Default Constructor
     *
     * @param string $loggerName Generally represents the class name.
     */
    private function __construct($loggerName)
    {
        $config = ConfigManager::getInstance()->getConfigHashmap();
        // Checks if custom factory defined, and is it an implementation of @PayULogFactory
        $factory = array_key_exists('log.AdapterFactory', $config) && in_array('PayU\Log\PayULogFactory', class_implements($config['log.AdapterFactory'])) ? $config['log.AdapterFactory'] : '\PayU\Log\PayUDefaultLogFactory';
        /** @var PayULogFactory $factoryInstance */
        $factoryInstance = new $factory();
        $this->logger = $factoryInstance->getLogger($loggerName);
        $this->loggerName = $loggerName;
    }

    /**
     * Returns the singleton object
     *
     * @param string $loggerName
     * @return $this
     */
    public static function getInstance($loggerName = __CLASS__)
    {
        if (array_key_exists($loggerName, LoggingManager::$instances)) {
            return LoggingManager::$instances[$loggerName];
        }
        $instance = new self($loggerName);
        LoggingManager::$instances[$loggerName] = $instance;
        return $instance;
    }

    /**
     * Log Error
     *
     * @param string $message
     */
    public function error($message)
    {
        $this->logger->error($message);
    }

    /**
     * Log Warning
     *
     * @param string $message
     */
    public function warning($message)
    {
        $this->logger->warning($message);
    }

    /**
     * Log Fine
     *
     * @param string $message
     */
    public function fine($message)
    {
        $this->info($message);
    }

    /**
     * Log Info
     *
     * @param string $message
     */
    public function info($message)
    {
        $this->logger->info($message);
    }

    /**
     * Log Debug
     *
     * @param string $message
     */
    public function debug($message)
    {
        $config = ConfigManager::getInstance()->getConfigHashmap();
        // Disable debug in live mode.
        if (array_key_exists('log.log_enabled', $config) && (bool)$config['log.log_enabled'] === true) {
            $this->logger->debug($message);
        }
    }
}
