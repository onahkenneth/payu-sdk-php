<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Handler;

use PayU\Core\Constants;
use PayU\Exception\ConfigurationException;
use PayU\Exception\InvalidCredentialException;
use PayU\Exception\MissingCredentialException;
use PayU\Http\Config;
use PayU\Model\UserAgent;

/**
 * Class BasicAuthHandler
 *
 * @package PayU\Handler
 */
class BasicAuthHandler implements PayUHandler
{
    /**
     * Private Variable
     *
     * @var \PayU\Soap\ApiContext $apiContext
     */
    private $apiContext;

    /**
     * Construct
     *
     * @param \PayU\Soap\ApiContext $apiContext
     */
    public function __construct($apiContext)
    {
        $this->apiContext = $apiContext;
    }

    /**
     * @param Config $httpConfig configuration hash
     * @param array $request transaction payload
     * @param mixed $options user defined options
     * @return mixed|void
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws MissingCredentialException
     */
    public function handle($httpConfig, $request, $options)
    {
        $config = $this->apiContext->getConfigHashmap();
        $credential = $this->apiContext->getCredential();

        $httpConfig->setEndpointUrl(
            rtrim(trim($this->getEndpoint($config)), '/') .
            (isset($options['path']) ? $options['path'] : '')
        );

        $headers = array(
            "User-Agent" => UserAgent::getValue(Constants::SDK_NAME, Constants::SDK_VERSION),
            "Authorization" => "Basic " . base64_encode(
                    $credential->getUsername() . ":" . $credential->getPassword()
                ),
            "Accept" => "*/*",
        );
        $httpConfig->setHeaders($headers);

        // Add any additional Headers that they may have provided
        $headers = $this->apiContext->getRequestHeaders();
        foreach ($headers as $key => $value) {
            $httpConfig->addHeader($key, $value);
        }
    }

    /**
     * Get base endpoint for SOAP WSDL service
     *
     * @param array $config
     *
     * @return string $baseEndpoint the WSDL endpoint
     * @throws \PayU\Exception\ConfigurationException
     */
    private static function getEndpoint($config)
    {
        if (isset($config['mode'])) {
            switch (strtoupper($config['mode'])) {
                case 'SANDBOX':
                    $baseEndpoint = Constants::STAGING_WSDL_ENDPOINT;
                    break;
                case 'LIVE':
                    $baseEndpoint = Constants::PROD_WSDL_ENDPOINT;
                    break;
                default:
                    throw new ConfigurationException('The mode config parameter must be set to either sandbox/live');
            }
        } else {
            // Defaulting to Sandbox
            $baseEndpoint = Constants::STAGING_WSDL_ENDPOINT;
        }

        $baseEndpoint = rtrim(trim($baseEndpoint), '/');

        return $baseEndpoint;
    }
}
