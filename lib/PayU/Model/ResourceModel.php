<?php

namespace PayU\Model;

use PayU\Api\Capture;
use PayU\Api\FmDetails;
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
 * @property string payUReference
 * @property string merchantReference
 * @property \PayU\Api\Customer customer
 * @property \PayU\Api\Transaction transaction
 * @property \PayU\Api\Merchant merchant
 * @property \PayU\Api\RedirectUrls redirectUrls
 * @property \PayU\Api\Response return
 * @property \PayU\Api\FmDetails fmDetails
 * @property \PayU\Api\TransactionRecord $transactionRecord
 */
class ResourceModel extends PayUModel implements Resource
{
    /**
     * @var ApiContext
     */
    protected static $apiContext;
    /**
     * @var Request
     */
    protected $request;

    /**
     * ResourceModel constructor.
     * @param null $data
     */
    public function __construct($data = null)
    {
        parent::__construct($data);

        $this->request = new Request();
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
        if ($this->id)
            return $this->id;

        return $this->return->payUReference;
    }

    /**
     * Payment intent.
     * Valid Values: ["PAYMENT", "RESERVE", "FINALIZE", "CREDIT", "RESERVE_CANCEL"]
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
     * Valid Values: ["PAYMENT", "RESERVE", "FINALIZE", "CREDIT", "RESERVE_CANCEL"]
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
     * @param \PayU\Api\RedirectUrls $redirectUrls
     *
     * @return $this
     */
    public function setRedirectUrls($redirectUrls)
    {
        $this->redirectUrls = $redirectUrls;
        return $this;
    }

    /**
     * Redirect URLs you provide for redirect/IPN.
     *
     * @return \PayU\Api\RedirectUrls
     */
    public function getRedirectUrls()
    {
        return $this->redirectUrls;
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
     * Transaction response
     *
     * @return \PayU\Api\Response
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * Fraud management details
     *
     * @param FmDetails $fmDetails
     * @return $this
     */
    public function setFmDetails($fmDetails)
    {
        $this->fmDetails = $fmDetails;
        return $this;
    }


    /**
     * Fraud management details
     *
     * @return \PayU\Api\FmDetails
     */
    public function getFmDetails()
    {
        return $this->fmDetails;
    }

    /**
     * Get 3DSecure Approval Form
     *
     * @return null|string
     */
    public function get3DSecureForm()
    {
        return $this->getReturn()->getSecure3D()->getSecure3DUrl();
    }

    /**
     * PayU identifier corresponding to this transaction.
     *
     * @param string $payUReference
     *
     * @return $this
     */
    public function setPayUReference($payUReference)
    {
        $this->payUReference = $payUReference;
        return $this;
    }

    /**
     * PayU identifier corresponding to this transaction.
     *
     * @return string
     */
    public function getPayUReference()
    {
        return $this->payUReference;
    }

    /**
     * Merchant reference is 16 digit number payment identification number to identify the payment.
     *
     * @param string $merchantReference
     *
     * @return $this
     */
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;
        return $this;
    }

    /**
     * Merchant is 16 digit number payment identification number to identify the payment.
     *
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * Debit Order transaction record
     *
     * @param  \PayU\Api\TransactionRecord $transactionRecord
     * @return $this
     */
    public function setTransactionRecord($transactionRecord)
    {
        $this->transactionRecord = $transactionRecord;
        return $this;
    }

    /**
     * Debit Order transaction record
     *
     * @return  \PayU\Api\TransactionRecord
     */
    public function getTransactionRecord()
    {
        return $this->transactionRecord;
    }

    public function parseResource($resource)
    {
        if (!$this->request) {
            $this->request = new Request();
        }

        return $this->request->parseResource($resource);
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
        self::$apiContext = $apiContext;
        $soapCall = $soapCall ? $soapCall : new SoapCall($apiContext);

        //Make the execution call
        $json = $soapCall->execute($method, $payLoad, $handlers, $headers, $path);
        return $json;
    }

    /**
     * Shows details a of payment or redirect resource.
     *
     * @param string $reference
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     * @return ResourceModel resource object
     */
    public static function get($reference, $apiContext = null, $soapCall = null)
    {
        $methodName = 'getTransaction';
        ArgumentValidator::validate($reference, 'PayUReference');
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
     * Setup a redirect payment process. In the JSON request body, include a `redirect` object with the intent,
     * customer, fundingInstrument, transaction etc. Also include return, notify, and cancel URLs in the `redirect` object.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration
     * and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     *
     * @return ResourceModel resource object
     */
    public function setup($apiContext = null, $soapCall = null)
    {
        $methodName = 'setTransaction';
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

    /**
     * Executes, or completes direct payment processing. In the JSON request body, include a `payment` object with the intent,
     * customer, fundingInstrument, transaction etc. Also include return, notify, and cancel URLs in the `payment` object.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic
     * configuration and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make API calls
     * @return ResourceModel resource object
     */
    public function create($apiContext = null, $soapCall = null)
    {
        $methodName = 'doTransaction';
        $payload = $this->request->parseForEnterpriseAPI($this);

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
        ArgumentValidator::validate($this->return->payUReference, "payUReference");
        ArgumentValidator::validate($this->return->merchantReference, 'merchantReference');
        $payLoad = $this->request->parseReserveResource($this);

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

    /**
     * Captures and processes an authorization, by ID. To use this call, the original payment call must specify an
     * intent of `reserve`.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param SoapCall $soapCall is the SOAP Call Service that is used to make rest calls
     *
     * @return Capture
     */
    public function capture($apiContext = null, $soapCall = null)
    {
        $methodName = 'doTransaction';
        ArgumentValidator::validate($this->payu_reference, "payUReference");
        ArgumentValidator::validate($this->merchant_reference, "merchantReference");
        $payLoad = $this->request->parseReserveResource($this);

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
     * @return ResourceModel
     */
    public function void($apiContext = null, $soapCall = null)
    {
        $methodName = 'doTransaction';
        ArgumentValidator::validate($this->getReturn()->getPayUReference(), "payUReference");
        ArgumentValidator::validate($this->getReturn()->getMerchantReference(), "merchantReference");
        $payLoad = $this->request->parseReserveResource($this);
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
