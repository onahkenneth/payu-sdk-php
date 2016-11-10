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
class ConfigurationTest extends TestCase
{
    const SAFE_KEY = '{CE62CE80-0EFD-4035-87C1-8824C5C46E7F}';
    const API_USERNAME = '100032';
    const API_PASSWORD = 'PypWWegU';
    const API_VERSION = '1.0';
    const PHP_SDK_VERSION = 'PHP SDK 1.0.0';

    public function testValidApiVersion()
    {
        //then
        $this->assertEquals(self::API_VERSION, Configuration::getApiVersion());
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
        Configuration::setEnvironment($environment);

        //then
        $this->assertEquals($environment, Configuration::getEnvironment());
    }

    public function testSetValidSafeKey()
    {
        //when
        Configuration::setSafeKey(self::SAFE_KEY);

        //then
        $this->assertEquals(self::SAFE_KEY, Configuration::getSafeKey());
    }

    public function testSetValidApiUsername()
    {
        //when
        Configuration::setApiUsername(self::API_USERNAME);

        //then
        $this->assertEquals(self::API_USERNAME, Configuration::getApiUsername());
    }

    public function testSetValidApiPassword()
    {
        //when
        Configuration::setApiPassword(self::API_PASSWORD);

        //then
        $this->assertEquals(self::API_PASSWORD, Configuration::getApiPassword());
    }

    /**
     * @expectedException \PayU\Exception\ConfigurationException
     * @expectedExceptionMessage Safe key cannot be empty
     */
    public function testSetInvalidSafeKey()
    {
        //when
        Configuration::setSafeKey('');
    }

    /**
     * @expectedException \PayU\Exception\ConfigurationException
     * @expectedExceptionMessage API username cannot be empty
     */
    public function testSetInvalidApiUsername()
    {
        //when
        Configuration::setApiUsername('');
    }

    /**
     * @expectedException \PayU\Exception\ConfigurationException
     * @expectedExceptionMessage API password cannot be empty
     */
    public function testSetInvalidApiPassword()
    {
        //when
        Configuration::setApiPassword('');
    }

    /**
     * @expectedException \PayU\Exception\ConfigurationException
     * @expectedExceptionMessage environment - is not valid environment
     */
    public function testSetInvalidEnvironment()
    {
        //when
        Configuration::setEnvironment('environment');
    }

    public function testSecureServiceUrl()
    {
        //when
        Configuration::setEnvironment('secure');

        //then
        $this->assertEquals('https://secure.payu.co.za/service/PayUAPI', Configuration::getServiceUrl());
    }

    public function testSandboxServiceUrl()
    {
        //when
        Configuration::setEnvironment('staging');

        //then
        $this->assertEquals('https://staging.payu.co.za/service/PayUAPI', Configuration::getServiceUrl());
    }


    public function testSetValidHashAlgorithm()
    {
        //when
        Configuration::setHashAlgorithm('SHA');

        //then
        $this->assertEquals('SHA', Configuration::getHashAlgorithm());
    }

    /**
     * @expectedException \PayU\Exception\ConfigurationException
     * @expectedExceptionMessage Hash algorithm "MD5"" is not available
     */
    public function testSetInvalidHashAlgorithm()
    {
        //when
    Configuration::setHashAlgorithm('MD5');
    }

    /**
     * @test
     */
    public function shouldReturnValidSDKVersionWhenComposerFileIsGiven()
    {
        //then
        $this->assertEquals(self::PHP_SDK_VERSION, Configuration::getSdkVersion());
    }

    /**
     * @test
     */
    public function shouldDefaultSDKVersionAndFromJsonIsTheSame()
    {
        //then
        $this->assertEquals(Configuration::DEFAULT_SDK_VERSION, Configuration::getSdkVersion());
    }
}
