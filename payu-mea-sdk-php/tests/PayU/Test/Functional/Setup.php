<?php

namespace PayU\Test\Functional;

use PayU\Auth\BasicAuth;
use PayU\Core\CredentialManager;
use PayU\Soap\ApiContext;
use PayU\Test\Constants;

class Setup
{

    public static $mode = 'mock';

    public static function SetUpForFunctionalTests(\PHPUnit_Framework_TestCase &$test)
    {
        $configs = array(
            'mode' => 'sandbox',
            'http.connection_timeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => '../PayPal.log',
            'log.LogLevel' => 'FINE',
            'validation.level' => 'log'
        );
        $test->apiContext = new ApiContext(
            new BasicAuth(Constants::API_USERNAME, Constants::API_PASSWORD, Constants::API_SAFEKEY)
        );
        $test->apiContext->setConfig($configs);

        //PayPalConfigManager::getInstance()->addConfigFromIni(__DIR__. '/../../../sdk_config.ini');
        //PayPalConfigManager::getInstance()->addConfigs($configs);
        CredentialManager::getInstance()->setCredentialObject(CredentialManager::getInstance()->getCredentialObject('acct1'));

        self::$mode = getenv('SOAP_MODE') ? getenv('SOAP_MODE') : 'mock';
        if (self::$mode != 'sandbox') {

            // Mock SOAP Caller if mode set to mock
            $test->mockSoapCall = $test->getMockBuilder('\PayU\Transport\SoapCall')
                ->disableOriginalConstructor()
                ->getMock();

            $test->mockSoapCall->expects($test->any())
                ->method('execute')
                ->will($test->returnValue(
                    $test->response
                ));
        }
    }
}
