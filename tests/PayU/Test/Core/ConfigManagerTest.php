<?php

use PayU\Core\ConfigManager;

class ConfigManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigManager
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new \ReflectionClass('PayU\Core\ConfigManager');
        runkit_constant_remove('PYU_CONFIG_PATH');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        //$property = $this->object->getProperty('instance');
        //$property->setValue(null);
    }


    public function testGetInstance()
    {
        define("PYU_CONFIG_PATH", dirname(dirname(dirname(__DIR__))));
        $this->object = ConfigManager::getInstance();
        $instance = $this->object->getInstance();
        $instance2 = $this->object->getInstance();
        $this->assertTrue($instance instanceof ConfigManager);
        $this->assertSame($instance, $instance2);
    }


    public function testGet()
    {
        define("PYU_CONFIG_PATH", dirname(dirname(dirname(__DIR__))));
        $this->object = ConfigManager::getInstance();
        $ret = $this->object->get('acct2');
        $this->assertConfiguration(
            array(
                'acct2.username' => 'Staging Integration Store 3',
                'acct2.password' => 'WSAUFbw6'),
            $ret
        );
        $this->assertTrue(sizeof($ret) == 5);

    }


    public function testGetIniPrefix()
    {
        define("PYU_CONFIG_PATH", dirname(dirname(dirname(__DIR__))));
        $this->object = ConfigManager::getInstance();

        $ret = $this->object->getIniPrefix();
        $this->assertContains('acct1', $ret);
        $this->assertEquals(sizeof($ret), 2);

        $ret = $this->object->getIniPrefix('Staging Integration Store 3');
        $this->assertEquals('acct2', $ret);
    }


    public function testConfigByDefault()
    {
        define("PYU_CONFIG_PATH", dirname(dirname(dirname(__DIR__))));
        $this->object = ConfigManager::getInstance();

        // Test file based config params and defaults
        $config = ConfigManager::getInstance()->getConfigHashmap();
        $this->assertConfiguration(array('mode' => 'sandbox', 'http.connection_timeout' => '60'), $config);
    }


    public function testConfigByCustom()
    {
        define("PYU_CONFIG_PATH", dirname(dirname(dirname(__DIR__))));
        $this->object = ConfigManager::getInstance();

        // Test custom config params and defaults
        $config = ConfigManager::getInstance()->addConfigs(array('mode' => 'custom', 'http.connection_timeout' => 900))->getConfigHashmap();
        $this->assertConfiguration(array('mode' => 'custom', 'http.connection_timeout' => '900'), $config);
    }


    public function testConfigByFileAndCustom() {
        define("PYU_CONFIG_PATH", __DIR__. '/non_existent/');
        $this->object = ConfigManager::getInstance();

        $config = ConfigManager::getInstance()->getConfigHashmap();
        $this->assertArrayHasKey('http.connection_timeout', $config);
        $this->assertEquals('900', $config['http.connection_timeout']);
        $this->assertEquals('1', $config['http.retry']);

        //Add more configs
        $config = ConfigManager::getInstance()->addConfigs(array('http.retry' => "10", 'mode' => 'sandbox'))->getConfigHashmap();
        $this->assertConfiguration(array('http.connection_timeout' => "900", 'http.retry' => "10", 'mode' => 'sandbox'), $config);
    }

    /**
     * Asserts if each configuration is available and has expected value.
     *
     * @param $conditions
     * @param $config
     */
    public function assertConfiguration($conditions, $config) {
        foreach($conditions as $key => $value) {
            $this->assertArrayHasKey($key, $config);
            $this->assertEquals($value, $config[$key]);
        }
    }
}
?>
