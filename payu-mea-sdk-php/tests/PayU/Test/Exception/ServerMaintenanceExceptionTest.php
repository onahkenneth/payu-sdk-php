<?php

use PayU\Exception\ServerMaintenanceException;

/**
 * Test class for ServerMaintenanceException.
 *
 */
class ServerMaintenanceExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ServerMaintenanceException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ServerMaintenanceException('Test ServerMaintenanceException');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testServerMaintenanceException()
    {
        $this->assertEquals('Test ServerMaintenanceException', $this->object->getMessage());
    }
}
