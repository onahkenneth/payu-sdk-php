<?php

namespace PayU\Test\Auth;

use PayU\Auth\BasicAuth;
use PayU\Test\Constants;

class OAuthTokenCredentialTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @group integration
     */
    public function testGetBasicAuth()
    {
        $cred = new BasicAuth(Constants::API_USERNAME, Constants::API_PASSWORD, Constants::API_SAFEKEY);
        $this->assertEquals(Constants::API_USERNAME, $cred->getUsername());
        $this->assertEquals(Constants::API_PASSWORD, $cred->getPassword());
        $this->assertEquals(Constants::API_SAFEKEY, $cred->getSafekey());
    }
}
