<?php

use PayU\Auth\BasicAuth;
use PayU\Soap\ApiContext;

/**
 * Test class for ApiContextTest.
 *
 */
class ApiContextTest extends PHPUnit_Framework_TestCase
{
    protected $username = '100032';
    protected $password = 'PypWWegU';
    protected $safekey = '{CE62CE80-0EFD-4035-87C1-8824C5C46E7F}';

    /**
     * @var ApiContext
     */
    public $apiContext;

    public function setUp()
    {
        $this->apiContext = new ApiContext(
            new BasicAuth(
            $this->username,
            $this->password,
            $this->safekey
        ));
    }

    public function testGetRequestId()
    {
        $requestId = $this->apiContext->getRequestId();
        $this->assertNull($requestId);
    }

    public function testSetRequestId()
    {
        $this->assertNull($this->apiContext->getRequestId());

        $expectedRequestId = 'random-value';
        $this->apiContext->setRequestId($expectedRequestId);
        $requestId = $this->apiContext->getRequestId();
        $this->assertEquals($expectedRequestId, $requestId);
    }

    public function testResetRequestId()
    {
        $this->assertNull($this->apiContext->getRequestId());

        $requestId = $this->apiContext->resetRequestId();
        $this->assertNotNull($requestId);

        // Tests that another resetRequestId call will generate a new ID
        $newRequestId = $this->apiContext->resetRequestId();
        $this->assertNotNull($newRequestId);
        $this->assertNotEquals($newRequestId, $requestId);
    }
}
