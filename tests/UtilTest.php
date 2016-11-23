<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 11/23/16
 * Time: 10:14 AM
 */

namespace PayU;


class UtilTest extends TestCase
{
    public function verifyGenerateSignData()
    {
        return array(
            array('SHA', 'sender=MerchantPosId;algorithm=SHA-256;signature=e4c8315c9ab2e097ef1221f3fbd1e761405d961760e538fb2e0055d3d90b5e35'),
            array('SHA-256', 'sender=MerchantPosId;algorithm=SHA-256;signature=e4c8315c9ab2e097ef1221f3fbd1e761405d961760e538fb2e0055d3d90b5e35'),
            array('SHA-384', 'sender=MerchantPosId;algorithm=SHA-384;signature=ef1f0258e004b4ade604115289a374a0cb54899ff48fc65ca6a23d5dfc6332dfd5a3a63de88b65743cff5ecf8db4fda2'),
            array('SHA-512', 'sender=MerchantPosId;algorithm=SHA-512;signature=3ebb7cd2b9f60dacda25835f323fb15adda3eb729da71fd61c9bfd41b97c6eeea47949cee0aaf5fa1a4d8fa9c065369aaeffd34afc4f376bd11dd8bfdd3c564d')
        );
    }

    /**
     * @test
     * @dataProvider verifyGenerateSignData
     */
    public function shouldGenerateSignData($algorithm, $expected)
    {
        //when
        $signature = Util::generateSignData(array('test'=>'PayUData'), $algorithm, Configuration::getSafeKey(), Configuration::getApiPassword());

        //then
        $this->assertEquals($expected, $signature);
    }

    public function verifySignatureDataProvider()
    {
        return array(
            array('MD5', '8375034eb737d520c829fad4026a38aa', true),
            array('SHA-1', '52bb16149d1a5ccc8ac05f8e435c30d82efd5364', true),
            array('SHA-256', '8b2fd55b48f150347df56ce18d787335f32ced1d67f214016476f7c0a8f09981', true),
            array('SHA-256', 'incorrectSignature', false)
        );
    }

    /**
     * @test
     * @dataProvider verifySignatureDataProvider
     */
    public function shouldVerifySignature($algorithm, $signature, $result)
    {
        //when
        $valid = Util::verifySignature('PayUData', $signature, Configuration::getSafeKey(), $algorithm);

        //then
        $this->assertEquals($valid, $result);
    }

    public function verifyParseSignatureDataProvider()
    {
        return array(
            array('', null),
            array(null, null),
            array('TEST', null),
            array(
                'sender=MerchantPosId;algorithm=SHA-256;signature=e4c8315c9ab2e097ef1221f3fbd1e761405d961760e538fb2e0055d3d90b5e35',
                (object) array('sender' => 'MerchantPosId', 'algorithm' => 'SHA-256', 'signature' => 'e4c8315c9ab2e097ef1221f3fbd1e761405d961760e538fb2e0055d3d90b5e35')
            )
        );
    }

    /**
     * @test
     * @dataProvider verifyParseSignatureDataProvider
     */
    public function shouldParseSignature($signature, $result)
    {
        //when
        $parsedSignature = Util::parseSignature($signature);

        //then
        $this->assertEquals($parsedSignature, $result);
    }
}