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
use PayU\Validation\ArgumentValidator;

/**
 * Class Reserve
 *
 * An authorization transaction.
 *
 * @package PayU\Api
 *
 * @property string payu_reference
 * @property string merchant_reference
 */
class Reserve extends ResourceModel
{
    /**
     * Identifier to the purchase or transaction unit corresponding to this authorization transaction.
     *
     * @param string $payu_reference
     *
     * @return $this
     */
    public function setPayUReference($payu_reference)
    {
        $this->payu_reference = $payu_reference;
        return $this;
    }

    /**
     * Identifier to the purchase or transaction unit corresponding to this authorization transaction.
     *
     * @return string
     */
    public function getPayUReference()
    {
        return $this->payu_reference;
    }

    /**
     * Merchant reference is 16 digit number payment identification number to identify the payment.
     *
     * @param string $merchant_reference
     *
     * @return $this
     */
    public function setMerchantReference($merchant_reference)
    {
        $this->merchant_reference = $merchant_reference;
        return $this;
    }

    /**
     * Merchant is 16 digit number payment identification number to identify the payment.
     *
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchant_reference;
    }

    /**
     * Captures and processes an authorization, by ID. To use this call, the original payment call must specify an
     * intent of `reserve`.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     *                                   and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make rest calls
     *
     * @return Capture
     */
    public function capture($apiContext = null, $soapCall = null)
    {
        $methodName = 'doTransaction';
        $payLoad = Request::reformatReserve($this);

        $json = self::executeCall(
            $methodName,
            $payLoad,
            null,
            $apiContext,
            $soapCall
        );
        $ret = new Capture();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Voids, or cancels, an authorization, by ID. You cannot void a fully captured authorization.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     * and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to  calls
     *
     * @return Reserve
     */
    public function void($apiContext = null, $soapCall = null)
    {
        $methodName = 'doTransaction';
        ArgumentValidator::validate($this->getReturn()->getPayUReference(), "PayUReference");
        $payLoad = Request::reformatReserve($this);
        $json = self::executeCall(
            $methodName,
            $payLoad,
            null,
            $apiContext,
            $soapCall
        );
        $this->fromJson($json);
        return $this;
    }

    /**
     * Reauthorizes a PayU account payment, by authorization ID. To ensure that funds are still available,
     * reauthorize a payment after the initial three-day honor period. Supports only the `amount` request parameter.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     *                                   and credentials.
     * @param SoapCall $soapCall is the Rest Call Service that is used to make rest calls
     *
     * @return Reserve
     */
    public function reauthorize($apiContext = null, $soapCall = null)
    {
        $methodName = 'doTransaction';
        ArgumentValidator::validate($this->getId(), "Id");
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            $methodName,
            $payLoad,
            null,
            $apiContext,
            $soapCall
        );
        $this->fromJson($json);
        return $this;
    }
}
