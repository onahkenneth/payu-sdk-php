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

use PayU\Conversion\Formatter;
use PayU\Model\PayUModel;
use PayU\Model\ResourceModel;

/**
 * Class Response
 *
 * Request class accepts a request resource and returns a re-formatted request payload
 *
 * @package PayU\Api
 */
class Request extends PayUModel
{
    /**
     * @var array request parameters
     */
    private $payload;

    /**
     * Parse a Payment resource into a request payload
     *
     * @param ResourceModel $resource the payment resource
     *
     * @return array $payload transaction payload for Enterprise API request
     */
    public function parseForEnterpriseAPI(ResourceModel $resource)
    {
        $this->initDefaultParams($resource);

        $this->parseRedirectUrls($resource);

        $this->parseCustomerInformation($resource);

        $this->parseCreditCardInformation($resource);

        $this->parseRealTimeRecurringEnterprise($resource);

        $this->parseFundingInstrument($resource);

        $this->parseFraudManagementParams($resource);

        $this->parseTransactionRecord($resource);

        $this->parseEbucks($resource);

        $this->parseEFT($resource);

        $this->overrideDefaultParams($resource);

        return $this->payload;
    }

    /**
     * Parse a Redirect resource into a request payload
     *
     * @param ResourceModel $resource the payment resource
     *
     * @return array $payload transaction payload for Redirect API request
     */
    public function parseForRedirectAPI(ResourceModel $resource)
    {
        $this->initDefaultParams($resource);

        $this->parseRedirectUrls($resource);

        $this->parseCustomerInformation($resource);

        $this->parseFraudManagementParams($resource);

        $this->parseTransactionRecord($resource);

        $this->overrideDefaultParams($resource);

        $this->parseRealTimeRecurringRedirect($resource);

        return $this->payload;
    }

    private function initDefaultParams(ResourceModel $resourceModel)
    {
        $transaction = $resourceModel->getTransaction();
        $amount = $transaction->getAmount();
        $total = Formatter::formatToInteger($amount->getTotal());

        $this->payload = array(
            'TransactionType' => $resourceModel->getIntent(),
            'AdditionalInformation' => array(
                'merchantReference' => $transaction->getInvoiceNumber()
            ),
            'Basket' => array(
                'currencyCode' => $amount->getCurrency(),
                'amountInCents' => $total,
                'description' => $transaction->getDescription()
            ),
        );
    }

    private function parseRedirectUrls(ResourceModel $resourceModel)
    {
        $payload = $this->payload;
        $redirectUrls = $resourceModel->getRedirectUrls();

        if ($redirectUrls) {
            $notifyUrl = $redirectUrls->getNotifyUrl() ?: '';
            $returnUrl = $redirectUrls->getReturnUrl() ?: '';
            $cancelUrl = $redirectUrls->getCancelUrl() ?: '';
            $payload = array_merge_recursive($payload, array(
                'AdditionalInformation' => array(
                    'notificationUrl' => $notifyUrl,
                    'returnUrl' => $returnUrl,
                    'cancelUrl' => $cancelUrl
                )));
        }

        $this->payload = $payload;
    }

    public function parseCustomerInformation(ResourceModel $resourceModel)
    {
        $payload = $this->payload;
        $customer = $resourceModel->getCustomer();
        $customerInfo = $customer->getCustomerInfo();

        if ($customerInfo) {
            $payload = array_merge($payload, array(
                'Customer' => array(
                    'ip' => $customer->getIPAddress(),
                    'email' => $customerInfo->getEmail(),
                    'mobile' => $customerInfo->getPhone(),
                    'lastName' => $customerInfo->getLastName(),
                    'firstName' => $customerInfo->getFirstName(),
                    'merchantUserId' => $customerInfo->getCustomerId(),
                    'countryCode' => $customerInfo->getCountryCode(),
                    'regionalId' => $customerInfo->getCountryOfResidence(),
                )
            ));
        }

        $this->payload = $payload;
    }

    private function parseCreditCardInformation(ResourceModel $resourceModel)
    {
        $payload = $this->payload;
        $customer = $resourceModel->getCustomer();
        $paymentMethod = $customer->getPaymentMethod();

        if ($paymentMethod && PaymentMethod::TYPE_CREDITCARD === $paymentMethod) {
            $card = $customer->getFundingInstrument()->getPaymentCard();
            $showBudget = $card->getShowBudget();
            if ($showBudget) {
                $payload = array_merge_recursive($payload, array(
                    'AdditionalInformation' => array(
                        'showBudget' => $showBudget
                    )));
            }

            $secured3D = $card->getSecure3D();
            if ($secured3D) {
                $payload = array_merge_recursive($payload, array(
                    'AdditionalInformation' => array(
                        'secure3d' => 'True',
                        'supportedPaymentMethods' => $paymentMethod
                    ),
                ));
            }

            $payload = array_merge($payload, array(
                'Creditcard' => array(
                    'amountInCents' => $payload['Basket']['amountInCents'],
                    'cardExpiry' => $card->getValidUntil(),
                    'cardNumber' => $card->getNumber(),
                    'cvv' => $card->getCvv2(),
                    'nameOnCard' => $card->getNameOnCard()
                ),
                'AuthenticationType' => 'N/A'
            ));
        }

        $this->payload = $payload;
    }

    private function parseRealTimeRecurringEnterprise(ResourceModel $resourceModel)
    {
        $payload = $this->payload;
        $customer = $resourceModel->getCustomer();
        $paymentMethod = $customer->getPaymentMethod();

        if ($paymentMethod && PaymentMethod::TYPE_REAL_TIME_RECURRING === $paymentMethod
            && !$customer->getFundingInstrument()->getCreditCardToken()
        ) {
            $card = $customer->getFundingInstrument()->getPaymentCard();
            $secure3D = $card->getSecure3D();
            if ($secure3D) {
                $payload = array_merge_recursive($payload, array(
                    'AdditionalInformation' => array(
                        'secure3D' => 'true',
                    ),
                ));
            }

            $payload = array_merge($payload, array(
                'Creditcard' => array(
                    'amountInCents' => $payload['Basket']['amountInCents'],
                    'cardExpiry' => $card->getValidUntil(),
                    'cardNumber' => $card->getNumber(),
                    'cvv' => $card->getCvv2(),
                    'nameOnCard' => $card->getNameOnCard()
                ),
                'Customfields' => array(
                    'key' => 'processingType',
                    'value' => PaymentMethod::TYPE_REAL_TIME_RECURRING
                ),
                'AuthenticationType' => 'TOKEN'
            ));
        }

        $this->payload = $payload;
    }

    private function parseFundingInstrument(ResourceModel $resourceModel)
    {
        $payload = $this->payload;
        $customer = $resourceModel->getCustomer();
        $fi = $customer->getFundingInstrument();

        $storeCard = $fi->getStoreCard();
        if ($storeCard) {
            $payload = array_merge_recursive($payload, array(
                'AdditionalInformation' => array(
                    'storePaymentMethod' => 'true',
                ),
            ));
        }

        $cardToken = $fi->getCreditCardToken();
        if ($cardToken) {
            $payload = array_merge($payload, array(
                'Creditcard' => array(
                    'amountInCents' => $payload['Basket']['amountInCents'],
                    'pmId' => $cardToken->getCreditCardId(),
                    'cvv' => $cardToken->getCvv2()
                ),
                'AuthenticationType' => 'TOKEN',
            ));
            if (PaymentMethod::TYPE_REAL_TIME_RECURRING === $customer->getPaymentMethod()) {
                $payload = array_merge($payload, array(
                    'Customfields' => array(
                        'key' => 'processingType',
                        'value' => PaymentMethod::TYPE_REAL_TIME_RECURRING
                    ),
                ));
            }
        }

        $this->payload = $payload;
    }

    private function parseFraudManagementParams(ResourceModel $resourceModel)
    {
        $payload = $this->payload;
        $transaction = $resourceModel->getTransaction();
        $fm = $transaction->getFraudManagement();

        if ($fm) {
            $payload = array_merge($payload, array(
                'Fraud' => array(
                    'checkFraudOverride' => $fm->getCheckFraudOverride(),
                    'merchantWebsite' => $fm->getMerchantWebsite(),
                    'pcFingerPrint' => $fm->getPCFingerPrint()
                ),
            ));

            $lineItemArray = array();
            $itemList = $transaction->getItemList();

            if ($itemList) {
                if (is_array($itemList->getItems())) {
                    foreach ($itemList->getItems() as $item) {
                        $price = $item->getPrice();
                        $amount = $item->getAmount();
                        $price = Formatter::formatToInteger($price);
                        $amount = Formatter::formatToInteger($amount);

                        $lineItemArray[] = array(
                            'amount' => $amount,
                            'costAmount' => $price,
                            'description' => $item->getDescription(),
                            'sku' => $item->getSku(),
                            'quantity' => $item->getQuantity()
                        );
                    }
                }
            }

            $shippingInfoArray = array();
            $shippingInfo = $transaction->getShippingInfo();
            if ($shippingInfo) {

                $shippingInfoArray = array(
                    'shippingId' => $shippingInfo->getId(),
                    'shippingFirstName' => $shippingInfo->getFirstName(),
                    'shippingLastName' => $shippingInfo->getLastName(),
                    'shippingEmail' => $shippingInfo->getEmail(),
                    'shippingAddress1' => $shippingInfo->getShippingAddress()->getLine1(),
                    'shippingAddress2' => $shippingInfo->getShippingAddress()->getLine2(),
                    'shippingAddressCity' => $shippingInfo->getShippingAddress()->getCity(),
                    'shippingCountryCode' => $shippingInfo->getShippingAddress()->getCountryCode(),
                    'shippingPostCode' => $shippingInfo->getShippingAddress()->getPostalCode(),
                    'shippingMethod' => $shippingInfo->getMethod(),
                    'shippingPhone' => $shippingInfo->getPhone()
                );
            }

            if (!empty($lineItemArray)) {
                $payload = array_merge_recursive($payload, array(
                    'Basket' => array('productLineItem' => $lineItemArray)
                ));
            }

            if (!empty($shippingInfo)) {
                $payload = array_merge_recursive($payload, array(
                    'Basket' => array('shippingDetails' => $shippingInfoArray)
                ));
            }

            $this->payload = $payload;
        }
    }

    private function parseTransactionRecord(ResourceModel $resourceModel)
    {
        $payload = $this->payload;
        $transactionRecord = $resourceModel->getTransactionRecord();

        if ($transactionRecord && $resourceModel->getIntent() === Transaction::TYPE_DEBIT_ORDER) {
            $payload = array_merge($payload, array(
                'TransactionRecord' => array(
                    'recurrences' => $transactionRecord->getRecurrences(),
                    'startDate' => $transactionRecord->getStartDate(),
                    'statementDescription' => $transactionRecord->getStatementDescription(),
                    'managedBy' => $transactionRecord->getManagedBy(),
                    'frequency' => $transactionRecord->getFrequency(),
                    'anonymousUser' => $transactionRecord->getAnonymousUser()
                )
            ));
            $callCenterRepIds = $transactionRecord->getCallCenterRepIds();
            if ($callCenterRepIds) {
                $payload = array_merge_recursive($payload, array(
                    'AdditionalInformation' => array(
                        'callCenterRepId' => implode(',', $callCenterRepIds)
                    )
                ));
            }

        }

        $this->payload = $payload;
    }

    private function parseEbucks(ResourceModel $resourceModel)
    {
        $payload = $this->payload;
        $customer = $resourceModel->getCustomer();
        $paymentMethod = $customer->getPaymentMethod();
        $amount = $resourceModel->getTransaction()->getAmount();
        $ebucks = $customer->getFundingInstrument()->getEbucks();

        if ($ebucks && PaymentMethod::TYPE_EBUCKS === $paymentMethod) {
            switch ($ebucks->getAction()) {
                case Ebucks::AUTHENTICATE_ACCOUNT:
                    $payload = array_merge($payload, array(
                        'Customfield' => array(
                            array(
                                'key' => 'action',
                                'value' => $ebucks->getAction(),
                            ),
                            array(
                                'key' => 'authenticateAccountType',
                                'value' => $ebucks->getAuthenticateAccountType(),
                            ),
                            array(
                                'key' => 'ebucksMemberIdentifier',
                                'value' => $ebucks->getEbucksMemberIdentifier(),
                            ),
                            array(
                                'key' => 'ebucksPin',
                                'value' => $ebucks->getEbucksPin()
                            )
                        ),
                    ));
                    break;
                case Ebucks::GENERATE_OTP:
                    $payload = array_merge($payload, array(
                        'Customfield' => array(
                            array(
                                'key' => 'action',
                                'value' => $ebucks->getAction(),
                            ),
                            array(
                                'key' => 'generateOTPType',
                                'value' => $ebucks->getGenerateOTPType(),
                            ),
                            array(
                                'key' => 'payUReference',
                                'value' => $ebucks->getPayUReference(),
                            ),
                            array(
                                'key' => 'ebucksAmount',
                                'value' => $ebucks->getEbucksAmount()
                            ),
                            array(
                                'key' => 'amountInCents',
                                'value' => Formatter::formatToInteger($amount->getTotal()),
                            )
                        ),
                    ));
                    break;
                case Ebucks::RESET_PASSWORD:
                    $payload = array_merge($payload, array(
                        'Customfield' => array(
                            array(
                                'key' => 'action',
                                'value' => $ebucks->getAction(),
                            ),
                            array(
                                'key' => 'authenticateAccountType',
                                'value' => 'EBUCKS',
                            ),
                            array(
                                'key' => 'ebucksMemberIdentifier',
                                'value' => $ebucks->getEbucksMemberIdentifier(),
                            ),
                            array(
                                'key' => 'ebucksPin',
                                'value' => $ebucks->getEbucksPin()
                            )
                        ),
                    ));
                    break;
                case Ebucks::PAYMENT:
                    $payload = array_merge($payload, array(
                        'Ebucks' => array(
                            'amountInCents' => Formatter::formatToInteger($ebucks->getEbucksAmount()),
                        ),
                        'Customfield' => array(
                            array(
                                'key' => 'ebucksOtp',
                                'value' => $ebucks->getEbucksOTP(),
                            ),
                            array(
                                'key' => 'ebucksAccountNumber',
                                'value' => $ebucks->getEbucksAccountNumber(),
                            ),
                        ),
                    ));
                    break;
            }
        }

        $this->payload = $payload;
    }

    private function parseEFT(ResourceModel $resourceModel)
    {
        $payload = $this->payload;
        $customer = $resourceModel->getCustomer();
        $paymentMethod = $customer->getPaymentMethod();
        $eft = $customer->getFundingInstrument()->getEft();

        if ($eft && PaymentMethod::TYPE_EFT_PRO === $paymentMethod) {
            $payload = array_merge_recursive($payload, array(
                'AdditionalInformation' => array(
                    'supportedPaymentMethods' => PaymentMethod::TYPE_EFT_PRO
                ),
                'Eft' => array(
                    'amountInCents' => Formatter::formatToInteger($eft->getAmount())
                )
            ));
        }

        if ($eft && PaymentMethod::TYPE_SMARTEFT === $paymentMethod) {
            $payload = array_merge($payload, array(
                'Eft' => array(
                    'bankName' => $eft->getBankName(),
                    'amountInCents' => Formatter::formatToInteger($eft->getAmount())
                ),
            ));
        }

        $this->payload = $payload;
    }

    private function overrideDefaultParams(ResourceModel $resourceModel)
    {
        $payload = $this->payload;
        $payUReference = $resourceModel->getPayUReference();

        if (!empty($payUReference)) {
            $payload = array_merge_recursive($payload, array(
                'AdditionalInformation' => array(
                    'payUReference' => $payUReference
                )
            ));
        }

        $this->payload = $payload;
    }

    private function parseRealTimeRecurringRedirect(ResourceModel $resourceModel)
    {
        $payload = $this->payload;
        $customer = $resourceModel->getCustomer();
        $paymentMethod = $customer->getPaymentMethod();

        if ($paymentMethod && PaymentMethod::TYPE_REAL_TIME_RECURRING === $paymentMethod) {
            $payload = array_merge_recursive($payload, array(
                'AdditionalInformation' => array(
                    'secure3D' => 'true',
                    'supportedPaymentMethods' => PaymentMethod::TYPE_CREDITCARD_TOKEN
                ),
                'Customfields' => array(
                    'key' => 'processingType',
                    'value' => PaymentMethod::TYPE_REAL_TIME_RECURRING
                ),
            ));
        }

        $this->payload = $payload;
    }

    /**
     * Parse a resource for void, credit, and capture transactions
     *
     * @param ResourceModel $resource the payment resource
     *
     * @return array $payload transaction payload for SOAP API request
     */
    public function parseReserveResource(ResourceModel $resource)
    {
        $intent = $resource->getIntent();
        $customer = $resource->getCustomer();
        $transaction = $resource->getTransaction();
        $amount = $transaction->getAmount();
        $total = Formatter::formatToInteger($amount->getTotal());
        $payuReference = $resource->getPayUReference() ?: $resource->getReturn()->getPayUReference();
        $merchantReference = $resource->getMerchantReference() ?: $resource->getReturn()->getMerchantReference();

        $payload = array(
            'TransactionType' => strtoupper($resource->intent),
            'AdditionalInformation' => array(
                'merchantReference' => $merchantReference,
                'payUReference' => $payuReference
            ),
            'Basket' => array(
                'currencyCode' => $amount->currency,
                'amountInCents' => $total
            ),
        );


        if ($intent === Transaction::TYPE_FINALIZE) {
            $paymentMethod = $customer->getPaymentMethod();
            if ($paymentMethod && PaymentMethod::TYPE_CREDITCARD == $paymentMethod) {
                $payload = array_merge($payload, array(
                    'Creditcard' => array(
                        'amountInCents' => $total
                    )
                ));
            }
        }

        return $payload;
    }
}
