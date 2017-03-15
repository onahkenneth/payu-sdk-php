<?php
/**
 * PayU EMEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Transport;

use PayU\Core\LoggingManager;
use PayU\Http\Config;
use PayU\Http\SoapConnection;
use PayU\Soap\ApiContext;

/**
 * Class PayUSoapCall
 *
 * @package PayU\Transport
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class SoapCall
{
    /**
     * PayU Logger
     *
     * @var LoggingManager logger interface
     */
    private $logger;

    /**
     * API Context
     *
     * @var ApiContext
     */
    private $apiContext;

    /**
     * Default Constructor
     *
     * @param ApiContext $apiContext
     */

    /**
     * Default Constructor
     *
     * @param ApiContext $apiContext
     */
    public function __construct(ApiContext $apiContext)
    {
        $this->apiContext = $apiContext;
        $this->logger = LoggingManager::getInstance(__CLASS__);
    }

    /**
     * @param string $methodName SOAP method - one of setTransaction, doTransaction, getTransaction etc
     * @param string $data Request payload
     * @param array $handlers Array of handlers
     * @param array $headers HTTP headers
     * @param string $path path to soap action
     * @return mixed
     * @throws \PayU\Exception\NetworkException
     */
    public function execute($methodName, $data = '', $handlers = array(), $headers = array(), $path = '')
    {
        $config = $this->apiContext->getConfig();
        $httpConfig = new Config(null, $methodName, $config);
        $headers = $headers ? $headers : array();
        $httpConfig->setHeaders($headers +
            array(
                'Content-Type' => 'text/xml'
            ));

        /** @var \PayU\Handler\PayUHandler $handler */
        foreach ($handlers as $handler) {
            if (!is_object($handler)) {
                $fullHandler = "\\" . (string)$handler;
                $handler = new $fullHandler($this->apiContext);
            }
            $handler->handle($httpConfig, $data, array('path' => $path));
        }

        $connection = new SoapConnection($this->apiContext, $httpConfig);
        $response = $connection->execute($methodName, $data);

        return $response;
    }
}
