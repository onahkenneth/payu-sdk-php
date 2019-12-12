<?php

namespace PayU\Log;

use PayU\Core\ConfigManager;
use Psr\Log\LogLevel;

/**
 * Class PayULogger
 *
 * This factory is the default implementation of Log factory.
 *
 * @package PayU\Log
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class PayULogger
{
    /**
     * @var array Indexed list of all log levels.
     */
    private $loggingLevels = array(
        LogLevel::EMERGENCY,
        LogLevel::ALERT,
        LogLevel::CRITICAL,
        LogLevel::ERROR,
        LogLevel::WARNING,
        LogLevel::NOTICE,
        LogLevel::INFO,
        LogLevel::DEBUG
    );

    /**
     * Configured Logging Level
     *
     * @var LogLevel $loggingLevel
     */
    private $loggingLevel;

    /**
     * Configured Logging File
     *
     * @var string
     */
    private $loggerFile;

    /**
     * Log Enabled
     *
     * @var bool
     */
    private $isLoggingEnabled;

    /**
     * Logger Name. Generally corresponds to class name
     *
     * @var string
     */
    private $loggerName;

    public function __construct($className)
    {
        $this->loggerName = $className;
        $this->initialize();
    }

    public function initialize()
    {
        $config = ConfigManager::getInstance()->getConfigHashmap();
        if (!empty($config)) {
            $this->isLoggingEnabled = (array_key_exists('log.log_enabled', $config) && $config['log.log_enabled'] == '1');
            if ($this->isLoggingEnabled) {
                $this->loggerFile = ($config['log.file_name']) ? $config['log.file_name'] : ini_get('error_log');
                $loggingLevel = strtoupper($config['log.log_level']);
                $this->loggingLevel = (isset($loggingLevel) && defined("\\Psr\\Log\\LogLevel::$loggingLevel")) ?
                    constant("\\Psr\\Log\\LogLevel::$loggingLevel") : LogLevel::INFO;
                $this->createLogFile();
            }
        }
    }

    public function info($message)
    {
        $this->log('INFO', $message);
    }

    public function log($level, $message, array $context = array())
    {
        if ($this->isLoggingEnabled) {
            // Checks if the message is at level below configured logging level
            if (array_search($level, $this->loggingLevels) <= array_search($this->loggingLevel, $this->loggingLevels)) {
                error_log("[" . date('d-m-Y h:i:s') . "] " . $this->loggerName . " : " . strtoupper($level) . ": $message\n", 3, $this->loggerFile);
            }
        }
    }

    public function debug($message)
    {
        $this->log('DEBUG', $message);
    }

    public function warning($message)
    {
        $this->log('WARNING', $message);
    }

    public function error($message)
    {
        $this->log('ERROR', $message);
    }

    protected function createLogFile()
    {
        if ($this->loggerFile !== '') {
            if (is_file($this->loggerFile) === true) {
                return;
            }

            $pathInfo = pathinfo($this->loggerFile);
            $path = $pathInfo['dirname'] ?? '';

            if ($this->makeDir($path)) {
                @fopen($this->loggerFile, 'a+');
            }
        }
    }

    /**
     * @param string $path
     * @param int    $mode
     *
     * @return bool
     */
    private function makeDir($path, $mode = 0755)
    {
        return is_dir($path) || @mkdir($path, $mode);
    }
}
