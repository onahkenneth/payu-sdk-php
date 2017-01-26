<?php
/**
 * PayU EMEA PHP SDK
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
use PayU\Transport\RestCall;
use PayU\Validation\ArgumentValidator;

/**
 * Class Order
 *
 * An order transaction.
 *
 * @package PayU\Api
 *
 * @property string id
 * @property string reference_id
 * @property \PayU\Api\Amount amount
 * @property string payment_mode
 * @property string state
 * @property string reason_code
 * @property string pending_reason
 * @property string protection_eligibility
 * @property string protection_eligibility_type
 * @property string parent_payment
 * @property \PayU\Api\FmDetails fmf_details
 * @property string create_time
 * @property string update_time
 */
class Order extends ResourceModel
{
    /**
     * Shows details for an order, by ID.
     *
     * @param string $orderId
     * @param ApiContext $apiContext is the APIContext for this call.
     *                               It can be used to pass dynamic configuration and credentials.
     * @param RestCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return Order
     */
    public static function get($orderId, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($orderId, 'orderId');
        $payLoad = "";
        $json = self::executeCall(
            "/v1/payments/orders/$orderId",
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Order();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Identifier of the order transaction.
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
     * Identifier to the purchase unit associated with this object. Obsolete. Use one in cart_base.
     *
     * @deprecated Use #setReferenceId instead
     *
     * @param string $purchase_unit_reference_id
     *
     * @return $this
     */
    public function setPurchaseUnitReferenceId($purchase_unit_reference_id)
    {
        $this->purchase_unit_reference_id = $purchase_unit_reference_id;
        return $this;
    }

    /**
     * Identifier to the purchase unit associated with this object. Obsolete. Use one in cart_base.
     *
     * @deprecated Use #getReferenceId instead
     *
     * @return string
     */
    public function getPurchaseUnitReferenceId()
    {
        return $this->purchase_unit_reference_id;
    }

    /**
     * Identifier to the purchase unit associated with this object. Obsolete. Use one in cart_base.
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
     * Identifier to the purchase unit associated with this object. Obsolete. Use one in cart_base.
     *
     * @return string
     */
    public function getReferenceId()
    {
        return $this->reference_id;
    }

    /**
     * Amount being collected.
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
     * Amount being collected.
     *
     * @return \PayU\Api\Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * specifies payment mode of the transaction
     * Valid Values: ["INSTANT_TRANSFER", "MANUAL_BANK_TRANSFER", "DELAYED_TRANSFER", "ECHECK"]
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
     * specifies payment mode of the transaction
     *
     * @return string
     */
    public function getPaymentMode()
    {
        return $this->payment_mode;
    }

    /**
     * State of the order transaction.
     * Valid Values: ["pending", "completed", "voided", "authorized", "captured"]
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
     * State of the order transaction.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Reason code for the transaction state being Pending or Reversed.
     * This field will replace pending_reason field eventually.
     * Valid Values: ["PAYER_SHIPPING_UNCONFIRMED", "MULTI_CURRENCY", "RISK_REVIEW",
     * "REGULATORY_REVIEW", "VERIFICATION_REQUIRED", "ORDER", "OTHER"]
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
     * Reason code for the transaction state being Pending or Reversed.
     * This field will replace pending_reason field eventually.
     *
     * @return string
     */
    public function getReasonCode()
    {
        return $this->reason_code;
    }

    /**
     * [DEPRECATED] Reason code for the transaction state being Pending.
     * Obsolete. Retained for backward compatability. Use reason_code field above instead.
     * Valid Values: ["payer_shipping_unconfirmed", "multi_currency", "risk_review",
     * "regulatory_review", "verification_required", "order", "other"]
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
     * @deprecated  [DEPRECATED] Reason code for the transaction state being Pending.
     * Obsolete. Retained for backward compatability. Use reason_code field above instead.
     *
     * @return string
     */
    public function getPendingReason()
    {
        return $this->pending_reason;
    }

    /**
     * The level of seller protection in force for the transaction.
     * Valid Values: ["ELIGIBLE", "PARTIALLY_ELIGIBLE", "INELIGIBLE"]
     *
     * @param string $protection_eligibility
     *
     * @return $this
     */
    public function setProtectionEligibility($protection_eligibility)
    {
        $this->protection_eligibility = $protection_eligibility;
        return $this;
    }

    /**
     * The level of seller protection in force for the transaction.
     *
     * @return string
     */
    public function getProtectionEligibility()
    {
        return $this->protection_eligibility;
    }

    /**
     * The kind of seller protection in force for the transaction.
     * This property is returned only when the `protection_eligibility`
     * property is set to `ELIGIBLE`or `PARTIALLY_ELIGIBLE`.
     *
     * Allowed values:<br> `ITEM_NOT_RECEIVED_ELIGIBLE`- Sellers are protected against claims for items not received.
     * <br> `UNAUTHORIZED_PAYMENT_ELIGIBLE`- Sellers are protected against claims for unauthorized payments.<br>
     * One or both of the allowed values can be returned.
     * Valid Values: ["ITEM_NOT_RECEIVED_ELIGIBLE", "UNAUTHORIZED_PAYMENT_ELIGIBLE",
     * "ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE"]
     *
     * @param string $protection_eligibility_type
     *
     * @return $this
     */
    public function setProtectionEligibilityType($protection_eligibility_type)
    {
        $this->protection_eligibility_type = $protection_eligibility_type;
        return $this;
    }

    /**
     * The kind of seller protection in force for the transaction.
     * This property is returned only when the `protection_eligibility`
     * property is set to `ELIGIBLE`or `PARTIALLY_ELIGIBLE`.
     * Allowed values:<br> `ITEM_NOT_RECEIVED_ELIGIBLE`- Sellers are protected against claims for items not received.
     * <br> `UNAUTHORIZED_PAYMENT_ELIGIBLE`- Sellers are protected against claims for unauthorized payments.<br>
     * One or both of the allowed values can be returned.
     *
     * @return string
     */
    public function getProtectionEligibilityType()
    {
        return $this->protection_eligibility_type;
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
     * Fraud Management (FM) details applied for the payment that could result in approved/deny/challenge action.
     *
     * @param \PayU\Api\FmDetails $fm_details
     *
     * @return $this
     */
    public function setFmfDetails($fm_details)
    {
        $this->fm_details = $fm_details;
        return $this;
    }

    /**
     * Fraud Management (FM) details applied for the payment that could result in approved/deny/challenge action.
     *
     * @return \PayU\Api\FmDetails
     */
    public function getFmfDetails()
    {
        return $this->fm_details;
    }

    /**
     * Time the resource was created in UTC ISO8601 format.
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
     * Time the resource was created in UTC ISO8601 format.
     *
     * @return string
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Time the resource was last updated in UTC ISO8601 format.
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
     * Time the resource was last updated in UTC ISO8601 format.
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Captures a payment for an order, by ID. To use this call,
     * the original payment call must specify an intent of `order`.
     * In the JSON request body, include the payment amount and
     * indicate whether this capture is the final capture for the authorization.
     *
     * @param Capture $capture
     * @param ApiContext $apiContext is the APIContext for this call.
     *                               It can be used to pass dynamic configuration and credentials.
     * @param RestCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return Capture
     */
    public function capture($capture, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($capture, 'capture');
        $payLoad = $capture->toJSON();
        $json = self::executeCall(
            "/v1/payments/orders/{$this->getId()}/capture",
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
     * Identifier of the order transaction.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Voids, or cancels, an order, by ID.
     * You cannot void an order if a payment has already been partially or fully captured.
     *
     * @param ApiContext $apiContext is the APIContext for this call.
     *                               It can be used to pass dynamic configuration and credentials.
     * @param RestCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return Order
     */
    public function void($apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        $payLoad = "";
        $json = self::executeCall(
            "/v1/payments/orders/{$this->getId()}/do-void",
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
     * Authorizes an order, by ID. Include an `amount` object in the JSON request body.
     *
     * @param Authorization $authorization Authorization Object with Amount value to be authorized
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic
     *                                     configuration and credentials.
     * @param RestCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return Authorization
     */
    public function authorize($authorization, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($authorization, 'Authorization');
        $payLoad = $authorization->toJSON();
        $json = self::executeCall(
            "/v1/payments/orders/{$this->getId()}/authorize",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Authorization();
        $ret->fromJson($json);
        return $ret;
    }
}
