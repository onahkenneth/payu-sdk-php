<?php

use PayU\Exception\NetworkException;

/**
 * Test class for NetworkException.
 *
 */
class NetworkExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NetworkException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new NetworkException('http://testURL', 'test message');
        $this->object->setData('response payload for connection');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @test
     */
    public function testGetUrl()
    {
        $this->assertEquals('http://testURL', $this->object->getUrl());
    }

    /**
     * @test
     */
    public function testGetData()
    {
        $this->assertEquals('response payload for connection', $this->object->getData());
    }

    /**
     * @test
     */
    public function testSetData()
    {
        $this->object->setData('response payload for connection');
        $this->assertEquals('response payload for connection', $this->object->getData());
    }
}
