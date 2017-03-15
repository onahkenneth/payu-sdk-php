<?php
/*
 * Sample bootstrap file.
 */

// Include the composer Autoloader
// The location of your project's vendor autoloader.
$composerAutoload = dirname(dirname(dirname(__DIR__))) . '/autoload.php';
if (!file_exists($composerAutoload)) {
    //If the project is used as its own project, it would use soap-api-sdk-php composer autoloader.
    $composerAutoload = dirname(__DIR__) . '/vendor/autoload.php';


    if (!file_exists($composerAutoload)) {
        echo "The 'vendor' folder is missing. You must run 'composer update' to resolve application dependencies.\nPlease see the README for more information.\n";
        exit(1);
    }
}
require $composerAutoload;
require __DIR__ . '/util.php';

use PayU\Auth\BasicAuth;
use PayU\Soap\ApiContext;

// Suppress DateTime warnings, if not set already
date_default_timezone_set(@date_default_timezone_get());

// Adding Error Reporting for understanding errors properly
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Replace these values by entering your own SOAP username and password by visiting https://help.payu.co.za/developers
$username = '100032';
$password = 'PypWWegU';
$safekey = '{CE62CE80-0EFD-4035-87C1-8824C5C46E7F}';
$storeId = '3D Sim Store FAuth Off Force On';
$paymentMethods = 'CREDITCARD,EBUCKS,EFT_PRO';
$fraudManagement = false;

/**
 * All default SOAP options are stored in the array inside the Http\Config class. To make changes to those settings
 * for your specific environments, feel free to add them using the code shown below
 * Uncomment below line to override any default SOAP options.
 */
//Http\Config::$defaultSoapOptions['trace'] = true;


/** @var \PayU\Soap\ApiContext $apiContext */
$apiContext = getApiContext($username, $password, $safekey, $paymentMethods, $fraudManagement);

return $apiContext;
/**
 * Helper method for getting an APIContext for all calls
 * @param string $username Web service username
 * @param string $password Web service password
 * @param string $safekey safe key
 * @return PayU\Soap\ApiContext
 */
function getApiContext($username, $password, $safekey, $paymentMethods, $fraudManagement)
{

    // #### SDK configuration
    // Register the sdk_config.ini file in current directory
    // as the configuration source.
    /*
    if(!defined("PP_CONFIG_PATH")) {
        define("PP_CONFIG_PATH", __DIR__);
    }
    */

    // ### Api context
    // Use an ApiContext object to authenticate
    // API calls. The username and password for the
    // BasicAuth class can be retrieved from
    // help.payu.co.za/developers

    $apiContext = new ApiContext(
        new BasicAuth(
            $username,
            $password,
            $safekey
        )
    );

    // Comment this line out and uncomment the PP_CONFIG_PATH
    // 'define' block if you want to use static file
    // based configuration

    $apiContext->setConfig(
        array(
            'mode' => 'sandbox',
            'log.LogEnabled' => true,
            'log.FileName' => '../PayU.log',
            'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct1.paymentMethods' => $paymentMethods,
            'acct1.fraudManagement' => $fraudManagement,
            //'http.connectTimeout' => 30
            //'log.AdapterFactory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    return $apiContext;
}
