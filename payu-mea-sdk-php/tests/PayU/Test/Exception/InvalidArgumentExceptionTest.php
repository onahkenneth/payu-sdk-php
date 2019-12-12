<?php
use PayU\Exception\InvalidArgumentException;

/**
 * Test class for ConfigurationException.
 *
 */
class InvalidArgumentExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InvalidArgumentException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new InvalidArgumentException('Test InvalidArgumentException');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testInvalidArgumentException()
    {
        $this->assertEquals('Test InvalidArgumentException', $this->object->getMessage());
    }
}
