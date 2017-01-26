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
 * Class Authorization
 *
 * An authorization transaction.
 *
 * @package PayU\Api
 *
 * @property string id
 * @property \PayU\Api\Amount amount
 * @property string payment_mode
 * @property string state
 * @property string reason_code
 * @property string pending_reason
 * @property string protection_eligibility
 * @property string protection_eligibility_type
 * @property \PayU\Api\FmDetails fm_details
 * @property string parent_payment
 * @property \PayU\Api\Response processor_response
 * @property string valid_until
 * @property string create_time
 * @property string update_time
 * @property string reference_id
 * @property string receipt_id
 */
class Authorization extends ResourceModel
{
    /**
     * Shows details for an authorization, by ID.
     *
     * @param string $authorizationId
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     *                                   and credentials.
     * @param SoapCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return Authorization
     */
    public static function get($authorizationId, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($authorizationId, 'authorizationId');
        $payLoad = "";
        $json = self::executeCall(
            "/v1/payments/authorization/$authorizationId",
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Authorization();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * ID of the authorization transaction.
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Amount being authorized.
     *
     * @param \PayU\Api\Amount $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Amount being authorized.
     *
     * @return \PayU\Api\Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Specifies the payment mode of the transaction.
     * Valid Values: ["INSTANT_TRANSFER"]
     *
     * @param string $payment_mode
     *
     * @return $this
     */
    public function setPaymentMode($payment_mode)
    {
        $this->payment_mode = $payment_mode;
        return $this;
    }

    /**
     * Specifies the payment mode of the transaction.
     *
     * @return string
     */
    public function getPaymentMode()
    {
        return $this->payment_mode;
    }

    /**
     * State of the authorization.
     * Valid Values: ["pending", "authorized", "partially_captured", "captured", "expired", "voided"]
     *
     * @param string $state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * State of the authorization.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Reason code, `AUTHORIZATION`, for a transaction state of `pending`.
     * Valid Values: ["AUTHORIZATION"]
     *
     * @param string $reason_code
     *
     * @return $this
     */
    public function setReasonCode($reason_code)
    {
        $this->reason_code = $reason_code;
        return $this;
    }

    /**
     * Reason code, `AUTHORIZATION`, for a transaction state of `pending`.
     *
     * @return string
     */
    public function getReasonCode()
    {
        return $this->reason_code;
    }

    /**
     * [DEPRECATED] Reason code for the transaction state being Pending.Obsolete. use reason_code field instead.
     * Valid Values: ["AUTHORIZATION"]
     *
     * @param string $pending_reason
     *
     * @return $this
     */
    public function setPendingReason($pending_reason)
    {
        $this->pending_reason = $pending_reason;
        return $this;
    }

    /**
     * @deprecated  [DEPRECATED] Reason code for the transaction state being Pending.Obsolete. use reason_code field
     *              instead.
     *
     * @return string
     */
    public function getPendingReason()
    {
        return $this->pending_reason;
    }

    /**
     * Fraud Management (FM) details applied for the payment that could result in accept, deny, or pending action.
     * Returned in a payment response only if the merchant has enabled FM in the profile settings and one of the fraud
     * filters was triggered based on those settings.
     *
     * @param \PayU\Api\FmDetails $fm_details
     *
     * @return $this
     */
    public function setFmDetails($fm_details)
    {
        $this->fm_details = $fm_details;
        return $this;
    }

    /**
     * Fraud Management (FM) details applied for the payment that could result in accept, deny, or pending action.
     * Returned in a payment response only if the merchant has enabled FM in the profile settings and one of the fraud
     * filters was triggered based on those settings.
     *
     * @return \PayU\Api\FmDetails
     */
    public function getFmDetails()
    {
        return $this->fm_details;
    }

    /**
     * ID of the Payment resource that this transaction is based on.
     *
     * @param string $parent_payment
     *
     * @return $this
     */
    public function setParentPayment($parent_payment)
    {
        $this->parent_payment = $parent_payment;
        return $this;
    }

    /**
     * ID of the Payment resource that this transaction is based on.
     *
     * @return string
     */
    public function getParentPayment()
    {
        return $this->parent_payment;
    }

    /**
     * Response codes returned by the processor concerning the submitted payment. Only supported when the
     * `payment_method` is set to `credit_card`.
     *
     * @param \PayU\Api\Response $response
     *
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * Response codes returned by the processor concerning the submitted payment. Only supported when the
     * `payment_method` is set to `credit_card`.
     *
     * @return \PayU\Api\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Authorization expiration time and date as defined in [RFC 3339 Section
     * 5.6](http://tools.ietf.org/html/rfc3339#section-5.6).
     *
     * @param string $valid_until
     *
     * @return $this
     */
    public function setValidUntil($valid_until)
    {
        $this->valid_until = $valid_until;
        return $this;
    }

    /**
     * Authorization expiration time and date as defined in [RFC 3339 Section
     * 5.6](http://tools.ietf.org/html/rfc3339#section-5.6).
     *
     * @return string
     */
    public function getValidUntil()
    {
        return $this->valid_until;
    }

    /**
     * Time of authorization as defined in [RFC 3339 Section 5.6](http://tools.ietf.org/html/rfc3339#section-5.6).
     *
     * @param string $create_time
     *
     * @return $this
     */
    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;
        return $this;
    }

    /**
     * Time of authorization as defined in [RFC 3339 Section 5.6](http://tools.ietf.org/html/rfc3339#section-5.6).
     *
     * @return string
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Time that the resource was last updated.
     *
     * @param string $update_time
     *
     * @return $this
     */
    public function setUpdateTime($update_time)
    {
        $this->update_time = $update_time;
        return $this;
    }

    /**
     * Time that the resource was last updated.
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Identifier to the purchase or transaction unit corresponding to this authorization transaction.
     *
     * @param string $reference_id
     *
     * @return $this
     */
    public function setReferenceId($reference_id)
    {
        $this->reference_id = $reference_id;
        return $this;
    }

    /**
     * Identifier to the purchase or transaction unit corresponding to this authorization transaction.
     *
     * @return string
     */
    public function getReferenceId()
    {
        return $this->reference_id;
    }

    /**
     * Receipt id is 16 digit number payment identification number returned for guest users to identify the payment.
     *
     * @param string $receipt_id
     *
     * @return $this
     */
    public function setReceiptId($receipt_id)
    {
        $this->receipt_id = $receipt_id;
        return $this;
    }

    /**
     * Receipt id is 16 digit number payment identification number returned for guest users to identify the payment.
     *
     * @return string
     */
    public function getReceiptId()
    {
        return $this->receipt_id;
    }

    /**
     * Captures and processes an authorization, by ID. To use this call, the original payment call must specify an
     * intent of `authorize`.
     *
     * @param Capture $capture
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     *                                   and credentials.
     * @param PayURestCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return Capture
     */
    public function capture($capture, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($capture, 'capture');
        $payLoad = $capture->toJSON();
        $json = self::executeCall(
            "/v1/payments/authorization/{$this->getId()}/capture",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Capture();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * ID of the authorization transaction.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Voids, or cancels, an authorization, by ID. You cannot void a fully captured authorization.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     *                                   and credentials.
     * @param PayURestCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return Authorization
     */
    public function void($apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        $payLoad = "";
        $json = self::executeCall(
            "/v1/payments/authorization/{$this->getId()}/void",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
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
     * @param PayURestCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return Authorization
     */
    public function reauthorize($apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            "/v1/payments/authorization/{$this->getId()}/reauthorize",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }
}
