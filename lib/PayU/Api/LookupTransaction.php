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

namespace PayU\Api;

use PayU\Model\ResourceModel;
use PayU\Soap\ApiContext;
use PayU\Transport\SoapCall;

/**
 * Class LookupTransaction
 *
 * @package PayU\Api
 *
 * @property Response return
 */
class LookupTransaction extends ResourceModel
{
    /**
     * Shows details for a payment, by ID.
     *
     * @param array $payload
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     * and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     * @return LookupTransaction
     */
    public static function lookup($payload, $apiContext = null, $soapCall = null)
    {
        $methodName = 'getLookupTransaction';

        $json = self::executeCall(
            $methodName,
            $payload,
            null,
            $apiContext,
            $soapCall
        );

        $ret = new self();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Lookup transction response
     *
     * @param array $return
     * @return $this
     */
    public function setReturn($return)
    {
        $this->return = $return;
        return $this;
    }

    /**
     * Lookup transction response
     *
     * @return Response
     */
    public function getReturn()
    {
        return $this->return;
    }
}