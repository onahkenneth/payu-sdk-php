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

namespace PayU\Api;

use PayU\Core\Constants;
use PayU\Model\ResourceModel;
use PayU\Soap\ApiContext;
use PayU\Transport\SoapCall;
use PayU\Validation\ArgumentValidator;

/**
 * Class Payment
 *
 * Lets you create, process and manage payments.
 *
 * @package PayU\Api
 *
 * @property string id
 * @property string intent
 * @property \PayU\Api\Customer customer
 * @property \PayU\Api\Transaction[] transactions
 * @property string state
 * @property string note_to_customer
 * @property \PayU\Api\Merchant merchant
 * @property \PayU\Api\RedirectUrls redirect_urls
 * @property string failure_reason
 * @property string create_time
 * @property string update_time
 */
class Payment extends ResourceModel
{
    /**
     * Shows details for a payment, by ID.
     *
     * @param string $paymentId
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     * and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     * @return Payment
     */
    public static function get($paymentId, $apiContext = null, $soapCall = null)
    {
        ArgumentValidator::validate($paymentId, 'paymentId');
        $payLoad = "";
        $json = self::executeCall(
            "",
            "getTransaction",
            $payLoad,
            null,
            $apiContext,
            $soapCall
        );
        $ret = new Payment();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * List payments that were made to the merchant who issues the request. Payments can be in any state.
     *
     * @param array $params
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic
     * configuration and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     * @return PaymentHistory
     */
    public static function all($params, $apiContext = null, $soapCall = null)
    {
        ArgumentValidator::validate($params, 'params');
        $payLoad = "";
        $json = self::executeCall(
            "",
            "GET",
            $payLoad,
            null,
            $apiContext,
            $soapCall
        );
        $ret = new PaymentHistory();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Identifier of the payment resource created.
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
     * Payment intent.
     * Valid Values: ["payment", "reserve"]
     *
     * @param string $intent
     *
     * @return $this
     */
    public function setIntent($intent)
    {
        $this->intent = $intent;
        return $this;
    }

    /**
     * Payment intent.
     *
     * @return string
     */
    public function getIntent()
    {
        return $this->intent;
    }

    /**
     * Source of the funds for this payment represented by a direct credit card.
     *
     * @param \PayU\Api\Customer $customer
     *
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * Source of the funds for this payment represented by a direct credit card.
     *
     * @return \PayU\Api\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Receiver of funds for this payment.
     * @param \PayU\Api\Merchant $payee
     *
     * @return $this
     */
    public function setMerchant($payee)
    {
        $this->payee = $payee;
        return $this;
    }

    /**
     * Receiver of funds for this payment.
     * @return \PayU\Api\Merchant
     */
    public function getMerchant()
    {
        return $this->payee;
    }

    /**
     * ID of the cart to execute the payment.
     * @deprecated Not publicly available
     * @param string $cart
     *
     * @return $this
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
        return $this;
    }

    /**
     * ID of the cart to execute the payment.
     * @deprecated Not publicly available
     * @return string
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Append Transactions to the list.
     *
     * @param \PayU\Api\Transaction $transaction
     * @return $this
     */
    public function addTransaction($transaction)
    {
        if (!$this->getTransactions()) {
            return $this->setTransactions(array($transaction));
        } else {
            return $this->setTransactions(
                array_merge($this->getTransactions(), array($transaction))
            );
        }
    }

    /**
     * Transactional details including the amount and item details.
     *
     * @return \PayU\Api\Transaction[]
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * Transactional details including the amount and item details.
     *
     * @param \PayU\Api\Transaction[] $transactions
     *
     * @return $this
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
        return $this;
    }

    /**
     * Remove Transactions from the list.
     *
     * @param \PayU\Api\Transaction $transaction
     * @return $this
     */
    public function removeTransaction($transaction)
    {
        return $this->setTransactions(
            array_diff($this->getTransactions(), array($transaction))
        );
    }

    /**
     * Append FailedTransactions to the list.
     * @deprecated Not publicly available
     * @param \PayU\Api\Error $error
     * @return $this
     */
    public function addFailedTransaction($error)
    {
        if (!$this->getFailedTransactions()) {
            return $this->setFailedTransactions(array($error));
        } else {
            return $this->setFailedTransactions(
                array_merge($this->getFailedTransactions(), array($error))
            );
        }
    }

    /**
     * Applicable for advanced payments like multi seller payment (MSP) to support partial failures
     *
     * @deprecated Not publicly available
     * @return \PayU\Api\Error[]
     */
    public function getFailedTransactions()
    {
        return $this->failed_transactions;
    }

    /**
     * Applicable for advanced payments like multi seller payment (MSP) to support partial failures
     *
     * @deprecated Not publicly available
     * @param \PayU\Api\Error[] $failed_transactions
     *
     * @return $this
     */
    public function setFailedTransactions($failed_transactions)
    {
        $this->failed_transactions = $failed_transactions;
        return $this;
    }

    /**
     * Remove FailedTransactions from the list.
     * @deprecated Not publicly available
     * @param \PayU\Api\Error $error
     * @return $this
     */
    public function removeFailedTransaction($error)
    {
        return $this->setFailedTransactions(
            array_diff($this->getFailedTransactions(), array($error))
        );
    }

    /**
     * Instructions for the customer to complete this payment.
     * @deprecated Not publicly available
     * @param \PayU\Api\PaymentInstruction $payment_instruction
     *
     * @return $this
     */
    public function setPaymentInstruction($payment_instruction)
    {
        $this->payment_instruction = $payment_instruction;
        return $this;
    }

    /**
     * Instructions for the customer to complete this payment.
     * @deprecated Not publicly available
     * @return \PayU\Api\PaymentInstruction
     */
    public function getPaymentInstruction()
    {
        return $this->payment_instruction;
    }

    /**
     * The state of the payment, authorization, or order transaction.
     * The value is:<ul><li><code>created</code>. The transaction was
     * successfully created.</li><li><code>approved</code>. The buyer
     * approved the transaction.</li><li><code>failed</code>. The
     * transaction request failed.</li></ul>
     * Valid Values: ["created", "approved", "failed", "partially_completed", "in_progress"]
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
     * The state of the payment, authorization, or order transaction.
     * The value is:<ul><li><code>created</code>. The transaction was
     * successfully created.</li><li><code>approved</code>. The buyer
     * approved the transaction.</li><li><code>failed</code>. The
     * transaction request failed.</li></ul>
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * free-form field for the use of clients to pass in a message to the payer
     *
     * @param string $note_to_payer
     *
     * @return $this
     */
    public function setNoteToCustomer($note_to_payer)
    {
        $this->note_to_payer = $note_to_payer;
        return $this;
    }

    /**
     * free-form field for the use of clients to pass in a message to the payer
     *
     * @return string
     */
    public function getNoteToCustomer()
    {
        return $this->note_to_payer;
    }

    /**
     * Redirect URLs you provide for redirect payments.
     *
     * @param \PayU\Api\RedirectUrls $redirect_urls
     *
     * @return $this
     */
    public function setRedirectUrls($redirect_urls)
    {
        $this->redirect_urls = $redirect_urls;
        return $this;
    }

    /**
     * Redirect URLs you provide for redirect payments.
     *
     * @return \PayU\Api\RedirectUrls
     */
    public function getRedirectUrls()
    {
        return $this->redirect_urls;
    }

    /**
     * Failure reason code returned when the payment failed for some valid reasons.
     * Valid Values: ["UNABLE_TO_COMPLETE_TRANSACTION", "INVALID_PAYMENT_METHOD",
     * "PAYER_CANNOT_PAY", "CANNOT_PAY_THIS_PAYEE", "REDIRECT_REQUIRED", "PAYEE_FILTER_RESTRICTIONS"]
     *
     * @param string $failure_reason
     *
     * @return $this
     */
    public function setFailureReason($failure_reason)
    {
        $this->failure_reason = $failure_reason;
        return $this;
    }

    /**
     * Failure reason code returned when the payment failed for some valid reasons.
     *
     * @return string
     */
    public function getFailureReason()
    {
        return $this->failure_reason;
    }

    /**
     * Payment creation time as defined in [RFC 3339 Section 5.6](http://tools.ietf.org/html/rfc3339#section-5.6).
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
     * Payment creation time as defined in [RFC 3339 Section 5.6](http://tools.ietf.org/html/rfc3339#section-5.6).
     *
     * @return string
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Payment update time as defined in [RFC 3339 Section 5.6](http://tools.ietf.org/html/rfc3339#section-5.6).
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
     * Payment update time as defined in [RFC 3339 Section 5.6](http://tools.ietf.org/html/rfc3339#section-5.6).
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Get Approval Link
     *
     * @return null|string
     */
    public function getApprovalLink()
    {
        return $this->getLink(Constants::APPROVAL_URL);
    }

    /**
     * Creates and processes a payment. In the JSON request body, include a `payment` object with the intent,
     * payer, and transactions. Also include return, and cancel URLs in the `payment` object.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     * and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     * @return Payment
     */
    public function create($apiContext = null, $soapCall = null)
    {
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            "",
            "setTransaction",
            $payLoad,
            null,
            $apiContext,
            $soapCall
        );
        $this->fromJson($json);
        return $this;
    }

    /**
     * Partially updates a payment, by ID. You can update the amount, shipping address, invoice ID, and custom data.
     * You cannot use patch after execute has been called.
     *
     * @param PatchRequest $patchRequest
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     * and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     * @return boolean
     */
    public function update($patchRequest, $apiContext = null, $soapCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($patchRequest, 'patchRequest');
        $payLoad = $patchRequest->toJSON();
        self::executeCall(
            "",
            "PATCH",
            $payLoad,
            null,
            $apiContext,
            $soapCall
        );
        return true;
    }

    /**
     * Identifier of the payment resource created.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Executes, or completes, a PayU payment that the payer has approved. You can optionally update
     * selective payment information when you execute a payment.
     *
     * @param PaymentExecution $paymentExecution
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic
     * configuration and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     * @return Payment
     */
    public function execute($paymentExecution, $apiContext = null, $soapCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($paymentExecution, 'paymentExecution');
        $payLoad = $paymentExecution->toJSON();
        $json = self::executeCall(
            "",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $soapCall
        );
        $this->fromJson($json);
        return $this;
    }
}
