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
        $acct6Username,
        $acct7Username,
    ),
    array(
        $acct6Password,
        $acct7Password,
    ),
    array(
        $acct6Safekey,
        $acct7Safekey,
    ),
    array(
        $acct6PaymentMethods,
        $acct7PaymentMethods,
    )
);

return $apiContext;

/**
 * Helper method for getting an APIContext for all calls
 * @param array $usernames Web service username
 * @param array $passwords Web service password
 * @param array $safekeys safe key
 * @param array $paymentMethods supported payment methods
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
    $credentialManager = \PayU\Core\CredentialManager::getInstance();

    $apiContextEnterprise = new ApiContext(
        $credentialManager->getCredentialObject('acct1')
    );

    $apiContextRedirect = new ApiContext(
        $credentialManager->getCredentialObject('acct2')
    );

    $apiContextFm = new ApiContext(
        $credentialManager->getCredentialObject('acct3')
    );

    $apiContextDebitOrder = new ApiContext(
        $credentialManager->getCredentialObject('acct4')
    );

    $apiContextRTR = new ApiContext(
        $credentialManager->getCredentialObject('acct5')
    );

    $apiContextEFTRedirect = new ApiContext(
        new BasicAuth(
            $usernames[0],
            $passwords[0],
            $safekeys[0]
        )
    );

    $apiContextCCToken = new ApiContext(
        new BasicAuth(
            $usernames[1],
            $passwords[1],
            $safekeys[1]
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
            'acct1.payment_methods' => $apiContextEnterprise->get('acct1.payment_methods'),
            'http.connect_timeout' => 1800,
            'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextRedirect->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct2.payment_methods' => $apiContextEnterprise->get('acct2.payment_methods'),
            //'http.connect_timeout' => 30
            //'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextFm->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct3.payment_methods' => $apiContextEnterprise->get('acct3.payment_methods'),
            //'http.connect_timeout' => 30
            //'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextDebitOrder->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct4.payment_methods' => $apiContextEnterprise->get('acct4.payment_methods'),
            //'http.connect_timeout' => 30
            //'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextRTR->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct5.payment_methods' => $apiContextEnterprise->get('acct5.payment_methods'),
            //'http.connect_timeout' => 30
            //'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextEFTRedirect->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct6.payment_methods' => $paymentMethods[0]
            //'http.connect_timeout' => 30
            //'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    $apiContextCCToken->setConfig(
        array(
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => '../PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'acct6.payment_methods' => $paymentMethods[1]
            //'http.connect_timeout' => 30
            //'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        )
    );

    return array(
        $apiContextEnterprise, $apiContextRedirect,
        $apiContextFm, $apiContextDebitOrder,
        $apiContextRTR, $apiContextEFTRedirect,
        $apiContextCCToken
    );
}
