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
$acct1Username = '100032';
$acct1Password = 'PypWWegU';
$acct1Safekey = '{CE62CE80-0EFD-4035-87C1-8824C5C46E7F}';
$acct1StoreId = '3D Sim Store FAuth Off Force On';
$acct1PaymentMethods = 'CREDITCARD';

$acct2Username = 'Staging Integration Store 3';
$acct2Password = 'WSAUFbw6';
$acct2Safekey = '{07F70723-1B96-4B97-B891-7BF708594EEA}';
$acct2StoreId = 'Staging Integration Store 3';
$acct2PaymentMethods = 'CREDITCARD,EBUCKS,EFT_PRO,DISCOVERYMILES';

$acct3Username = 'Staging Enterprise With Fraud Integration Store 1';
$acct3Password = 'xoV3PFor';
$acct3Safekey = '{CF86C6D5-016C-4E98-9E4F-0F4FE3A0C1BA}';
$acct3StoreId = 'Staging Enterprise With Fraud Integration Store 1';
$acct3PaymentMethods = 'CREDITCARD';

$acct4Username = '200022';
$acct4Password = 'XSWYgMUA';
$acct4Safekey = '{826BD3C4-9663-48B0-804B-044BAA6A57F1}';
$acct4StoreId = 'Staging Integration Store 2';
$acct4PaymentMethods = 'CREDITCARD';

$acct5Username = '200239';
$acct5Password = '5AlTRPoD';
$acct5Safekey = '{542595FF-78EC-4A42-996D-18F8790393E5}';
$acct5StoreId = 'Staging Integration Store (RTR)';
$acct5PaymentMethods = 'CREDIT_CARD';

$acct6Username = 'Staging Integration Store 3';
$acct6Password = 'WSAUFbw6';
$acct6Safekey = '{07F70723-1B96-4B97-B891-7BF708594EEA}';
$acct6StoreId = 'Staging Integration Store 3';
$acct6PaymentMethods = 'EFT_PRO';

$acct7Username = '200239';
$acct7Password = '5AlTRPoD';
$acct7Safekey = '{07F70723-1B96-4B97-B891-7BF708594EEA}';
$acct7StoreId = 'Staging Integration Store';
$acct7PaymentMethods = 'CREDITCARD';


/**
 * All default SOAP options are stored in the array inside the Http\Config class. To make changes to those settings
 * for your specific environments, feel free to add them using the code shown below
 * Uncomment below line to override any default SOAP options.
 */
//Http\Config::$defaultSoapOptions['trace'] = true;


/** @var \PayU\Soap\ApiContext $apiContext */
$apiContext = getApiContext(
    array(
        $acct1Username, $acct2Username,
        $acct3Username, $acct4Username,
        $acct5Username, $acct6Username,
        $acct7Username,
    ),
    array(
        $acct1Password, $acct2Password,
        $acct3Password, $acct4Password,
        $acct5Password, $acct6Password,
        $acct7Password,
    ),
    array(
        $acct1Safekey, $acct2Safekey,
        $acct3Safekey, $acct4Safekey,
        $acct5Safekey, $acct6Safekey,
        $acct7Safekey,
    ),
    array(
        $acct1PaymentMethods, $acct2PaymentMethods,
        $acct3PaymentMethods, $acct4PaymentMethods,
        $acct5PaymentMethods, $acct6PaymentMethods,
        $acct7PaymentMethods,
    )
);

return $apiContext;
/**
 * Helper method for getting an APIContext for all calls
 * @param string $username Web service username
 * @param string $password Web service password
 * @param string $safekey safe key
 * @return array PayU\Soap\ApiContext[]
 */
function getApiContext($usernames, $passwords, $safekeys, $paymentMethods)
{

    // #### SDK configuration
    // Register the sdk_config.ini file in current directory
    // as the configuration source.

    if(!defined("PYU_CONFIG_PATH")) {
        define("PYU_CONFIG_PATH", __DIR__);
    }

    // ### Api context
    // Use an ApiContext object to authenticate
    // API calls. The username and password for the
    // BasicAuth class can be retrieved from
    // https://help.payu.co.za/display/developers/Test+Credentials

    $apiContextEnterprise = new ApiContext(
        new BasicAuth(
            $usernames[0],
            $passwords[0],
            $safekeys[0]
        )
    );

    $apiContextRedirect = new ApiContext(
        new BasicAuth(
            $usernames[1],
            $passwords[1],
            $safekeys[1]
        )
    );

    $apiContextFm = new ApiContext(
        new BasicAuth(
            $usernames[2],
            $passwords[2],
            $safekeys[2]
        )
    );

    $apiContextDebitOrder = new ApiContext(
        new BasicAuth(
            $usernames[3],
            $passwords[3],
            $safekeys[3]
        )
    );

    $apiContextRTR = new ApiContext(
        new BasicAuth(
            $usernames[4],
            $passwords[4],
            $safekeys[4]
        )
    );

    $apiContextEFTRedirect = new ApiContext(
        new BasicAuth(
            $usernames[5],
            $passwords[5],
            $safekeys[5]
        )
    );

    $apiContextCCToken = new ApiContext(
        new BasicAuth(
            $usernames[6],
            $passwords[6],
            $safekeys[6]
        )
    );

    // Comment this line out and uncomment the PP_CONFIG_PATH
    // 'define' block if you want to use static file
    // based configuration

    $apiContextEnterprise->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct1.payment_methods' => $paymentMethods[0]
            //'http.connect_timeout' => 30
            //'log.AdapterFactory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextRedirect->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct2.payment_methods' => $paymentMethods[1]
            //'http.connect_timeout' => 30
            //'log.AdapterFactory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextFm->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct3.payment_methods' => $paymentMethods[2]
            //'http.connect_timeout' => 30
            //'log.AdapterFactory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextDebitOrder->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct4.payment_methods' => $paymentMethods[3]
            //'http.connect_timeout' => 30
            //'log.AdapterFactory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextRTR->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct5.payment_methods' => $paymentMethods[4]
            //'http.connect_timeout' => 30
            //'log.AdapterFactory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextEFTRedirect->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct6.payment_methods' => $paymentMethods[5]
            //'http.connect_timeout' => 30
            //'log.AdapterFactory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextCCToken->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct6.payment_methods' => $paymentMethods[6]
            //'http.connect_timeout' => 30
            //'log.AdapterFactory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    return array(
        $apiContextEnterprise, $apiContextRedirect,
        $apiContextFm, $apiContextDebitOrder,
        $apiContextRTR, $apiContextEFTRedirect,
        $apiContextCCToken
    );
}
