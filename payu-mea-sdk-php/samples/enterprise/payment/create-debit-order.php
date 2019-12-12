<?php

// # CreateDebitOrderSample
//
// This sample code demonstrate how you can process
// a debit order.

require __DIR__ . '/../../bootstrap.php';

use PayU\Api\Address;
use PayU\Api\Amount;
use PayU\Api\CreditCard;
use PayU\Api\Customer;
use PayU\Api\CustomerInfo;
use PayU\Api\FundingInstrument;
use PayU\Api\Payment;
use PayU\Api\PaymentCard;
use PayU\Api\PaymentMethod;
use PayU\Api\RedirectUrls;
use PayU\Api\Transaction;
use PayU\Api\TransactionRecord;
use PayU\Soap\ApiContext;

// ### Address
// A resource representing a customer shipping/billing address information
$addr = new Address();
$addr->setLine1("21 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

// ### CreditCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new CreditCard();
$card->setType(PaymentCard::TYPE_VISA)
    ->setNumber("4000015372250142")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("123")
    ->setFirstName("John")
    ->setLastName("Snow")
    ->setBillingAddress($addr)
    ->setBillingCountry("ZA");

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$fi = new FundingInstrument();
$fi->setPaymentCard($card);

// ### CustomerInfo
// A resource representing a customer detailed information
$ci = new CustomerInfo();
$ci->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@gmail.com')
    ->setCountryCode('27')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('858')
    ->setBillingAddress($addr);

// ### Customer
// A resource representing a Customer that funds a payment.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD)
    ->setCustomerInfo($ci)
    ->setIpAddress('127.0.0.1')
    ->setFundingInstrument($fi);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("ZAR")
    ->setTotal(200.00);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid('payu'));

// A transaction record defines the debit order transaction details.
$transactionRecord = new TransactionRecord();
$transactionRecord->setRecurrences(6)
    ->setStartDate('2014/07/26')
    ->setStatementDescription('Subscription')
    ->setManagedBy('MERCHANT')
    ->setFrequency('W')
    ->setAnonymousUser(true)
    ->setCallCenterRepIds(array('25', '56'));

$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl("$baseUrl/process-return.php");


// ### Redirect
// A Redirect Payment Resource; create with intent set to 'debit_order'
$payment = new Payment();
$payment->setIntent(Transaction::TYPE_DEBIT_ORDER)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setRedirectUrls($redirectUrls)
    ->setTransactionRecord($transactionRecord);

// Redirect API integration.
$apiContext[3]->setAccountId('acct4')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $payment;

// ### Setup Redirect Debit Order
// Setup redirect by calling the redirect->setup() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// `getPayURedirectUrl` will return the url for redirection.
try {
    $payment->create($apiContext[3]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Create Debit Order Payment. If 500 Exception, check response for details', 'Redirect', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Create Debit Order Payment.", "Redirect", $payment->getId(), $request, $payment);


return $payment;
