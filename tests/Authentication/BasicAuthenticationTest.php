<?php

namespace PayU\Authentication;

/**
 * PayU PHP SDK Library
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class BasicAuthenticationTest extends \PayU\TestCase
{
    const API_USERNAME = '100032';
    const API_PASSWORD = 'PypWWegU';

    private $expectedHeaders;

    /**
     * @test
     * @expectedException \PayU\Exception\ConfigurationException
     * @expectedExceptionMessage API username is empty
     */
    public function shouldThrowExceptionWhenEmptyApiUsername()
    {
        //when
        new BasicAuthentication(null, null);
    }

    /**
     * @test
     * @expectedException \PayU\Exception\ConfigurationException
     * @expectedExceptionMessage API password is empty
     */
    public function shouldExceptionWhenEmptySignatureId()
    {
        //when
        new BasicAuthentication(self::API_USERNAME, null);
    }

    /**
     * @test
     */
    public function shouldGetCorrectHeaders()
    {
        //given
        $this->expectedHeaders = array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode(self::API_USERNAME . ':' . self::API_PASSWORD),
        );

        //when
        $authBasic = new BasicAuthentication(self::API_USERNAME, self::API_PASSWORD);

        //then
        $this->assertEquals($this->expectedHeaders, $authBasic->getHeaders());
    }
}