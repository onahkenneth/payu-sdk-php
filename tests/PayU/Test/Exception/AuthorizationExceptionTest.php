<?php

use PayU\Exception\AuthorizationException;

/**
 * Test class for ConfigurationException.
 *
 */
class AuthorizationExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AuthorizationException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new AuthorizationException('Test AuthorizationException');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testAuthorizationException()
    {
        $this->assertEquals('Test AuthorizationException', $this->object->getMessage());
    }
}
