<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Model\ResourceModel;
use PayU\Soap\ApiContext;
use PayU\Transport\SoapCall;

/**
 * Class Payment
 *
 * Lets you create, process and manage redirect payments.
 *
 * @package PayU\Api
 */
class Redirect extends ResourceModel
{
    const REDIRECT_URL = 'https://%s.payu.co.za/rpp.do?PayUReference=%s';

    /**
     * PayU redirect url. Customer is redirected to PayU to capture payment details.
     *
     * @return string|null
     */
    public function getPayURedirectUrl()
    {
        $mode = parent::$apiContext->get('mode');
        $reference = $this->return->payUReference;

        if (!$mode || !$reference)
            return null;

        $url = sprintf(self::REDIRECT_URL, $mode === 'sandbox' ? 'staging' : 'secure', $reference);

        return $url;
    }

    /**
     * Executes, or completes direct payment processing.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic
     * configuration and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     * @return ResourceModel resource object
     */
    public function create($apiContext = null, $soapCall = null)
    {
        $methodName = 'doTransaction';
        $payload = $this->request->parseForRedirectAPI($this);

        $json = self::executeCall(
            $methodName,
            $payload,
            null,
            $apiContext,
            $soapCall
        );
        $this->fromJson($json);

        return $this;
    }
}
