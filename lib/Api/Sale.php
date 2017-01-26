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
 * Class Sale
 *
 * A sale transaction. This is the resource that is returned as a part related resources in Payment
 *
 * @package PayU\Api
 *
 * @property string id
 * @property \PayU\Api\Amount amount
 * @property string payment_mode
 * @property string state
 * @property string reason_code
 * @property string protection_eligibility
 * @property string protection_eligibility_type
 * @property string clearing_time
 * @property string payment_hold_status
 * @property string[] payment_hold_reasons
 * @property \PayU\Api\Currency transaction_fee
 * @property \PayU\Api\Currency receivable_amount
 * @property string exchange_rate
 * @property \PayU\Api\FmDetails fm_details
 * @property string receipt_id
 * @property string parent_payment
 * @property \PayU\Api\ProcessorResponse processor_response
 * @property string create_time
 * @property string update_time
 */
class Sale extends ResourceModel
{
    /**
     * Shows details for a sale, by ID. Returns only sales that were created through the REST API.
     *
     * @param string $saleId
     * @param ApiContext $apiContext is the APIContext for this call.
     *                               It can be used to pass dynamic configuration and credentials.
     * @param RestCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return Sale
     */
    public static function get($saleId, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($saleId, 'saleId');
        $payLoad = "";
        $json = self::executeCall(
            "/v1/payments/sale/$saleId",
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Sale();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Identifier of the sale transaction.
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
     * Identifier to the purchase or transaction unit corresponding to this sale transaction.
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
     * Identifier to the purchase or transaction unit corresponding to this sale transaction.
     *
     * @return string
     */
    public function getPurchaseUnitReferenceId()
    {
        return $this->purchase_unit_reference_id;
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
     * Specifies payment mode of the transaction.
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
     * Specifies payment mode of the transaction.
     *
     * @return string
     */
    public function getPaymentMode()
    {
        return $this->payment_mode;
    }

    /**
     * State of the sale transaction.
     * Valid Values: ["completed", "partially_refunded", "pending", "refunded", "denied"]
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
     * State of the sale transaction.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Reason code for the transaction state being Pending or Reversed.
     * Valid Values: ["CHARGEBACK", "GUARANTEE", "BUYER_COMPLAINT", "REFUND",
     * "UNCONFIRMED_SHIPPING_ADDRESS", "ECHECK", "INTERNATIONAL_WITHDRAWAL",
     * "RECEIVING_PREFERENCE_MANDATES_MANUAL_ACTION", "PAYMENT_REVIEW",
     * "REGULATORY_REVIEW", "UNILATERAL", "VERIFICATION_REQUIRED",
     * "TRANSACTION_APPROVED_AWAITING_FUNDING"]
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
     *
     * @return string
     */
    public function getReasonCode()
    {
        return $this->reason_code;
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
     * It is returned only when protection_eligibility is ELIGIBLE or PARTIALLY_ELIGIBLE.
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
     * It is returned only when protection_eligibility is ELIGIBLE
     * or PARTIALLY_ELIGIBLE.
     *
     * @return string
     */
    public function getProtectionEligibilityType()
    {
        return $this->protection_eligibility_type;
    }

    /**
     * Transaction fee applicable for this payment.
     *
     * @param \PayU\Api\Currency $transaction_fee
     *
     * @return $this
     */
    public function setTransactionFee($transaction_fee)
    {
        $this->transaction_fee = $transaction_fee;
        return $this;
    }

    /**
     * Transaction fee applicable for this payment.
     *
     * @return \PayU\Api\Currency
     */
    public function getTransactionFee()
    {
        return $this->transaction_fee;
    }

    /**
     * Net amount the merchant receives for this transaction in their receivable currency.
     * Returned only in cross-currency use cases where a merchant bills a buyer in a
     * non-primary currency for that buyer.
     *
     * @param \PayU\Api\Currency $receivable_amount
     *
     * @return $this
     */
    public function setReceivableAmount($receivable_amount)
    {
        $this->receivable_amount = $receivable_amount;
        return $this;
    }

    /**
     * Net amount the merchant receives for this transaction in their receivable currency.
     * Returned only in cross-currency use cases where a merchant bills a buyer in a
     * non-primary currency for that buyer.
     *
     * @return \PayU\Api\Currency
     */
    public function getReceivableAmount()
    {
        return $this->receivable_amount;
    }

    /**
     * Exchange rate applied for this transaction.
     * Returned only in cross-currency use cases
     * where a merchant bills a buyer in a non-primary
     * currency for that buyer.
     *
     * @param string $exchange_rate
     *
     * @return $this
     */
    public function setExchangeRate($exchange_rate)
    {
        $this->exchange_rate = $exchange_rate;
        return $this;
    }

    /**
     * Exchange rate applied for this transaction.
     * Returned only in cross-currency use cases
     * where a merchant bills a buyer in a non-primary
     * currency for that buyer.
     *
     * @return string
     */
    public function getExchangeRate()
    {
        return $this->exchange_rate;
    }

    /**
     * Fraud Management (FM) details applied for the payment
     * that could result in accept, deny, or pending action.
     * Returned in a payment response only if the merchant has
     * enabled FMF in the profile settings and one of the fraud
     * filters was triggered based on those settings.
     *
     * @param \PayU\Api\FmDetails $fmf_details
     *
     * @return $this
     */
    public function setFmfDetails($fmf_details)
    {
        $this->fmf_details = $fmf_details;
        return $this;
    }

    /**
     * Fraud Management (FM) details applied for the payment
     * that could result in accept, deny, or pending action.
     * Returned in a payment response only if the merchant
     * has enabled FMF in the profile settings and one of
     * the fraud filters was triggered based on those settings.
     *
     * @return \PayU\Api\FmDetails
     */
    public function getFmfDetails()
    {
        return $this->fmf_details;
    }

    /**
     * Receipt id is a payment identification number returned for guest users to identify the payment.
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
     * Receipt id is a payment identification number returned for guest users to identify the payment.
     *
     * @return string
     */
    public function getReceiptId()
    {
        return $this->receipt_id;
    }

    /**
     * ID of the payment resource on which this transaction is based.
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
     * ID of the payment resource on which this transaction is based.
     *
     * @return string
     */
    public function getParentPayment()
    {
        return $this->parent_payment;
    }

    /**
     * Response codes returned by the processor concerning the submitted payment.
     * Only supported when the `payment_method` is set to `credit_card`.
     *
     * @param \PayU\Api\ProcessorResponse $processor_response
     *
     * @return $this
     */
    public function setProcessorResponse($processor_response)
    {
        $this->processor_response = $processor_response;
        return $this;
    }

    /**
     * Response codes returned by the processor concerning the submitted payment.
     * Only supported when the `payment_method` is set to `credit_card`.
     *
     * @return \PayU\Api\ProcessorResponse
     */
    public function getProcessorResponse()
    {
        return $this->processor_response;
    }

    /**
     * ID of the billing agreement used as reference to execute this transaction.
     *
     * @param string $billing_agreement_id
     *
     * @return $this
     */
    public function setBillingAgreementId($billing_agreement_id)
    {
        $this->billing_agreement_id = $billing_agreement_id;
        return $this;
    }

    /**
     * ID of the billing agreement used as reference to execute this transaction.
     *
     * @return string
     */
    public function getBillingAgreementId()
    {
        return $this->billing_agreement_id;
    }

    /**
     * Time of sale as defined in [RFC 3339 Section 5.6](http://tools.ietf.org/html/rfc3339#section-5.6)
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
     * Time of sale as defined in [RFC 3339 Section 5.6](http://tools.ietf.org/html/rfc3339#section-5.6)
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
     * Refund a completed payment by passing the sale_id in the request URI.
     * In addition, include an empty JSON payload in the request body for a
     * full refund. For a partial refund, include an amount object in the request body.
     *
     * @deprecated Please use #refundSale instead.
     *
     * @param Refund $refund
     * @param ApiContext $apiContext is the APIContext for this call.
     *                               It can be used to pass dynamic configuration and credentials.
     * @param RestCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return Refund
     */
    public function refund($refund, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($refund, 'refund');
        $payLoad = $refund->toJSON();
        $json = self::executeCall(
            "/v1/payments/sale/{$this->getId()}/refund",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Refund();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Identifier of the sale transaction.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Refunds a sale, by ID. For a full refund, include an empty payload in the JSON
     * request body. For a partial refund, include an `amount` object in the JSON request body.
     *
     * @param RefundRequest $refundRequest
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to
     *                                  pass dynamic configuration and credentials.
     * @param RestCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return DetailedRefund
     */
    public function refundSale($refundRequest, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($refundRequest, 'refundRequest');
        $payLoad = $refundRequest->toJSON();
        $json = self::executeCall(
            "/v1/payments/sale/{$this->getId()}/refund",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new DetailedRefund();
        $ret->fromJson($json);
        return $ret;
    }
}
