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
 * Class PaymentInstruction
 *
 * Contain details of how and when the payment should be made to PayU in cases of manual bank transfer.
 *
 * @package PayU\Api
 *
 * @property string reference_number
 * @property string instruction_type
 * @property \PayU\Api\MerchantBankingInstruction merchant_banking_instruction
 * @property \PayU\Api\Currency amount
 * @property string payment_due_date
 * @property string note
 */
class PaymentInstruction extends ResourceModel
{
    /**
     * Retrieve a payment instruction by passing the payment_id in the request URI. Use this request if
     * you are implementing a solution that includes delayed payment like Pay Upon Invoice (PUI).
     *
     * @param string $paymentId
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic
     *                               configuration and credentials.
     * @param RestCall $restCall is the Rest Call Service that is used to make rest calls
     *
     * @return PaymentInstruction
     */
    public static function get($paymentId, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($paymentId, 'paymentId');
        $payLoad = "";
        $json = self::executeCall(
            "/v1/payments/payment/$paymentId/payment-instruction",
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new PaymentInstruction();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * ID of payment instruction
     *
     * @param string $reference_number
     *
     * @return $this
     */
    public function setReferenceNumber($reference_number)
    {
        $this->reference_number = $reference_number;
        return $this;
    }

    /**
     * ID of payment instruction
     *
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->reference_number;
    }

    /**
     * Type of payment instruction
     * Valid Values: ["MANUAL_BANK_TRANSFER", "PAY_UPON_INVOICE"]
     *
     * @param string $instruction_type
     *
     * @return $this
     */
    public function setInstructionType($instruction_type)
    {
        $this->instruction_type = $instruction_type;
        return $this;
    }

    /**
     * Type of payment instruction
     *
     * @return string
     */
    public function getInstructionType()
    {
        return $this->instruction_type;
    }

    /**
     * Recipient bank Details.
     *
     * @param \PayU\Api\MerchantBankingInstruction $recipient_banking_instruction
     *
     * @return $this
     */
    public function setRecipientBankingInstruction($recipient_banking_instruction)
    {
        $this->recipient_banking_instruction = $recipient_banking_instruction;
        return $this;
    }

    /**
     * Recipient bank Details.
     *
     * @return \PayU\Api\MerchantBankingInstruction
     */
    public function getRecipientBankingInstruction()
    {
        return $this->recipient_banking_instruction;
    }

    /**
     * Amount to be transferred
     *
     * @param \PayU\Api\Currency $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Amount to be transferred
     *
     * @return \PayU\Api\Currency
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Date by which payment should be received
     *
     * @param string $payment_due_date
     *
     * @return $this
     */
    public function setPaymentDueDate($payment_due_date)
    {
        $this->payment_due_date = $payment_due_date;
        return $this;
    }

    /**
     * Date by which payment should be received
     *
     * @return string
     */
    public function getPaymentDueDate()
    {
        return $this->payment_due_date;
    }

    /**
     * Additional text regarding payment handling
     *
     * @param string $note
     *
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * Additional text regarding payment handling
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
}
