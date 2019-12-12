<?php

use PayU\Core\CredentialManager;

/**
 * Test class for CredentialManager.
 *
 * @runTestsInSeparateProcesses
 */
class CredentialManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CredentialManager
     */
    protected $object;

    private $config = array(
        'acct1.username' => '100032',
        'acct1.password' => 'PypWWegU',
        'acct1.safekey' => '{CE62CE80-0EFD-4035-87C1-8824C5C46E7F}',
        'acct1.storeId' => '3D Sim Store FAuth Off Force On',
        'acct1.paymentMethods' => 'CREDITCARD,EBUCKS,EFT_PRO',
        'acct1.fraudManagement' => false,
        'http.ConnectionTimeOut' => '30',
        'http.Retry' => '5',
        'service.RedirectURL' => 'https://www.sandbox.paypal.com/webscr&cmd=',
        'service.DevCentralURL' => 'https://developer.paypal.com',
        'service.EndPoint.IPN' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
        'service.EndPoint.AdaptivePayments' => 'https://svcs.sandbox.paypal.com/',
        'service.SandboxEmailAddress' => 'platform_sdk_seller@gmail.com',
        'log.FileName' => 'PayPal.log',
        'log.LogLevel' => 'INFO',
        'log.LogEnabled' => '1',
    );

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = CredentialManager::getInstance($this->config);
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
    public function testGetInstance()
    {
        $instance = $this->object->getInstance($this->config);
        $this->assertTrue($instance instanceof CredentialManager);
    }

    /**
     * @test
     */
    public function testGetSpecificCredentialObject()
    {
        $cred = $this->object->getCredentialObject('acct1');
        $this->assertNotNull($cred);
        $this->assertAttributeEquals('100032', 'username', $cred);
        $this->assertAttributeEquals('PypWWegU', 'password', $cred);
        $this->assertAttributeEquals('{CE62CE80-0EFD-4035-87C1-8824C5C46E7F}', 'safekey', $cred);
    }

    /**
     * @after testGetDefaultCredentialObject
     *
     * @throws \PayU\Exception\InvalidCredentialException
     */
    public function testSetCredentialObject()
    {
        $authObject = $this->getMockBuilder('\PayU\Auth\BasicAuth')
            ->disableOriginalConstructor()
            ->getMock();
        $cred = $this->object->setCredentialObject($authObject)->getCredentialObject();

        $this->assertNotNull($cred);
        $this->assertSame($this->object->getCredentialObject(), $authObject);
    }

    /**
     * @after testGetDefaultCredentialObject
     *
     * @throws \PayU\Exception\InvalidCredentialException
     */
    public function testSetCredentialObjectWithUserId()
    {
        $authObject = $this->getMockBuilder('\PayU\Auth\BasicAuth')
            ->disableOriginalConstructor()
            ->getMock();
        $cred = $this->object->setCredentialObject($authObject, 'sample')->getCredentialObject('sample');
        $this->assertNotNull($cred);
        $this->assertSame($this->object->getCredentialObject(), $authObject);
    }

    /**
     * @after testGetDefaultCredentialObject
     *
     * @throws \PayU\Exception\InvalidCredentialException
     */
    public function testSetCredentialObjectWithoutDefault()
    {
        $authObject = $this->getMockBuilder('\PayU\Auth\BasicAuth')
            ->disableOriginalConstructor()
            ->getMock();
        $cred = $this->object->setCredentialObject($authObject, null, false)->getCredentialObject();
        $this->assertNotNull($cred);
        $this->assertNotSame($this->object->getCredentialObject(), $authObject);
    }


    /**
     * @test
     */
    public function testGetInvalidCredentialObject()
    {
        $this->setExpectedException('PayU\Exception\InvalidCredentialException');
        $cred = $this->object->getCredentialObject('invalid_biz_api1.gmail.com');
    }

    /**
     *
     */
    public function testGetDefaultCredentialObject()
    {
        $cred = $this->object->getCredentialObject();
        $this->assertNotNull($cred);
        $this->assertAttributeEquals('100032', 'username', $cred);
        $this->assertAttributeEquals('PypWWegU', 'password', $cred);
        $this->assertAttributeEquals('{CE62CE80-0EFD-4035-87C1-8824C5C46E7F}', 'safekey', $cred);
    }

    /**
     * @test
     */
    public function testGetSoapCredentialObject()
    {
        $cred = $this->object->getCredentialObject('acct1');

        $this->assertNotNull($cred);

        $this->assertAttributeEquals($this->config['acct1.username'], 'username', $cred);

        $this->assertAttributeEquals($this->config['acct1.password'], 'password', $cred);

        $this->assertAttributeEquals($this->config['acct1.safekey'], 'safekey', $cred);
    }
}
