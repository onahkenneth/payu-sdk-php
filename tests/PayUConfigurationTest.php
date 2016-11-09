<?php

namespace PayU;

/**
 * PayU PHP SDK Library
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class PayUConfigurationTest extends TestCase
{
    const SAFE_KEY = '{CE62CE80-0EFD-4035-87C1-8824C5C46E7F}';
    const API_USERNAME = '100032';
    const API_PASSWORD = 'PypWWegU';
    const API_VERSION = '1.0';
    const PHP_SDK_VERSION = 'PHP SDK 1.0.0';

    public function testValidApiVersion()
    {
        //then
        $this->assertEquals(self::API_VERSION, PayUConfiguration::getApiVersion());
    }

    public function getCorrectEnvironments()
    {
        return array(
            array('secure'),
            array('staging')
        );
    }

    /**
     * @dataProvider getCorrectEnvironments
     */
    public function testSetValidEnvironment($environment)
    {
        //when
        PayUConfiguration::setEnvironment($environment);

        //then
        $this->assertEquals($environment, PayUConfiguration::getEnvironment());
    }

    public function testSetValidSafeKey()
    {
        //when
        PayUConfiguration::setSafeKey(self::SAFE_KEY);

        //then
        $this->assertEquals(self::SAFE_KEY, PayUConfiguration::getSafeKey());
    }

    public function testSetValidApiUsername()
    {
        //when
        PayUConfiguration::setApiUsername(self::API_USERNAME);

        //then
        $this->assertEquals(self::API_USERNAME, PayUConfiguration::getApiUsername());
    }

    public function testSetValidApiPassword()
    {
        //when
        PayUConfiguration::setApiPassword(self::API_PASSWORD);

        //then
        $this->assertEquals(self::API_PASSWORD, PayUConfiguration::getApiPassword());
    }

    /**
     * @expectedException PayU\Exception\PayUConfigurationException
     * @expectedExceptionMessage Safe key cannot be empty
     */
    public function testSetInvalidSafeKey()
    {
        //when
        PayUConfiguration::setSafeKey('');
    }

    /**
     * @expectedException PayU\Exception\PayUConfigurationException
     * @expectedExceptionMessage API username cannot be empty
     */
    public function testSetInvalidApiUsername()
    {
        //when
        PayUConfiguration::setApiUsername('');
    }

    /**
     * @expectedException PayU\Exception\PayUConfigurationException
     * @expectedExceptionMessage API password cannot be empty
     */
    public function testSetInvalidApiPassword()
    {
        //when
        PayUConfiguration::setApiPassword('');
    }

    /**
     * @expectedException PayU\Exception\PayUConfigurationException
     * @expectedExceptionMessage environment - is not valid environment
     */
    public function testSetInvalidEnvironment()
    {
        //when
        PayUConfiguration::setEnvironment('environment');
    }

    public function testSecureServiceUrl()
    {
        //when
        PayUConfiguration::setEnvironment('secure');

        //then
        $this->assertEquals('https://secure.payu.co.za/service/PayUAPI', PayUConfiguration::getServiceUrl());
    }

    public function testSandboxServiceUrl()
    {
        //when
        PayUConfiguration::setEnvironment('staging');

        //then
        $this->assertEquals('https://staging.payu.co.za/service/PayUAPI', PayUConfiguration::getServiceUrl());
    }


    public function testSetValidHashAlgorithm()
    {
        //when
        PayUConfiguration::setHashAlgorithm('SHA');

        //then
        $this->assertEquals('SHA', PayUConfiguration::getHashAlgorithm());
    }

    /**
     * @expectedException PayU\Exception\PayUConfigurationException
     * @expectedExceptionMessage Hash algorithm "MD5"" is not available
     */
    public function testSetInvalidHashAlgorithm()
    {
        //when
        PayUConfiguration::setHashAlgorithm('MD5');
    }

    /**
     * @test
     */
    public function shouldReturnValidSDKVersionWhenComposerFileIsGiven()
    {
        //then
        $this->assertEquals(self::PHP_SDK_VERSION, PayUConfiguration::getSdkVersion());
    }

    /**
     * @test
     */
    public function shouldDefaultSDKVersionAndFromJsonIsTheSame()
    {
        //then
        $this->assertEquals(PayUConfiguration::DEFAULT_SDK_VERSION, PayUConfiguration::getSdkVersion());
    }
}
