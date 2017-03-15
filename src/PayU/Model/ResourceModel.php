<?php

namespace PayU\Model;

use PayU\Api\Refund;
use PayU\Api\Request;
use PayU\Resource;
use PayU\Soap\ApiContext;
use PayU\Transport\SoapCall;
use PayU\Validation\ArgumentValidator;

/**
 * Class ResourceModel
 *
 * An executable ResourceModel class
 *
 * @property string id
 * @property string intent
 * @property \PayU\Api\Customer customer
 * @property \PayU\Api\Transaction transaction
 * @property \PayU\Api\Merchant merchant
 * @property \PayU\Api\RedirectUrls redirect_urls
 * @property \PayU\Api\Response return
 */
class ResourceModel extends PayUModel implements Resource
{
    /**
     * Shows details for a payment, by ID.
     *
     * @param string $reference
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     * and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     * @return ResourceModel resource object
     */
    public static function get($reference, $apiContext = null, $soapCall = null)
    {
        $methodName = 'getTransaction';
        ArgumentValidator::validate($reference, 'payUReference');
        $payload = array(
            'AdditionalInformation' => array(
                'payUReference' => $reference
            )
        );

        $json = self::executeCall(
            $methodName,
            $payload,
            null,
            $apiContext,
            $soapCall
        );

        $ret = new static();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Execute SDK Call to PayU services
     *
     * @param string $method
     * @param string $payLoad
     * @param array $headers
     * @param ApiContext $apiContext
     * @param SoapCall $restCall
     * @param array $handlers
     * @return string json response of the object
     */
    protected static function executeCall(
        $method,
        $payLoad,
        $headers = array(),
        $apiContext = null,
        $soapCall = null,
        $handlers = array('PayU\Handler\BasicAuthHandler'),
        $path = ''
    )
    {
        //Initialize the context and rest call object if not provided explicitly
        $apiContext = $apiContext ? $apiContext : new ApiContext(self::$credential);
        $soapCall = $soapCall ? $soapCall : new SoapCall($apiContext);

        //Make the execution call
        $json = $soapCall->execute($method, $payLoad, $handlers, $headers, $path);
        return $json;
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
     * Identifier of the payment resource created.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Payment intent.
     * Valid Values: ["payment", "reserve", "finalize", "credit", "reserve_cancel"]
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
     * @param \PayU\Api\Merchant $merchant
     *
     * @return $this
     */
    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
        return $this;
    }

    /**
     * Receiver of funds for this payment.
     * @return \PayU\Api\Merchant
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * Transactional details including the amount and item details.
     *
     * @return \PayU\Api\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Transactional details including the amount and item details.
     *
     * @param \PayU\Api\Transaction $transaction
     *
     * @return $this
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
        return $this;
    }

    /**
     * Redirect URLs you provide for redirect/IPN.
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
     * Redirect URLs you provide for redirect/IPN.
     *
     * @return \PayU\Api\RedirectUrls
     */
    public function getRedirectUrls()
    {
        return $this->redirect_urls;
    }

    /**
     * Transaction response
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
     * Get Approval Form
     *
     * @return null|string
     */
    public function getApprovalForm()
    {
        return $this->getReturn()->getSecure3D()->getSecure3DUrl();
    }

    /**
     * Transaction response
     *
     * @return \PayU\Api\Response
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * Creates and processes a payment. In the JSON request body, include a `payment` object with the intent,
     * customer, and transactions. Also include return, notify, and cancel URLs in the `payment` object.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     * and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     *
     * @return ResourceModel resource object
     */
    public function callSetTransaction($apiContext = null, $soapCall = null)
    {
        $methodName = 'setTransaction';
        $payload = Request::reformatPayment($this);

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

    /**
     * Executes, or completes, a PayU payment that the customer has approved.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic
     * configuration and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     * @return ResourceModel resource object
     */
    public function callDoTransaction($apiContext = null, $soapCall = null)
    {
        $methodName = 'doTransaction';
        $payload = Request::reformatPayment($this);

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

    /**
     * Refund a captured payment.
     * In addition, include an amount object in the body of the request JSON.
     *
     * @param ApiContext $apiContext is the APIContext for this call.
     * It can be used to pass dynamic configuration and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make calls
     *
     * @return ResourceModel
     */
    public function refund($apiContext = null, $soapCall = null)
    {
        $methodName = 'doTransaction';
        ArgumentValidator::validate($this->return->payUReference, "PayUReference");
        ArgumentValidator::validate($this->return->merchantReference, 'MerchantReference');
        $payLoad = Request::reformatReserve($this);

        $json = self::executeCall(
            $methodName,
            $payLoad,
            null,
            $apiContext,
            $soapCall
        );

        $ret = new Refund();
        $ret->fromJson($json);
        return $ret;
    }
}
