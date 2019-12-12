<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../bootstrap.php';

use PayU\Api\Address;
use PayU\Api\Amount;
use PayU\Api\Customer;
use PayU\Api\CustomerInfo;
use PayU\Api\Ebucks;
use PayU\Api\FundingInstrument;
use PayU\Api\Payment;
use PayU\Api\PaymentMethod;
use PayU\Api\RedirectUrls;
use PayU\Api\Transaction;
use PayU\Soap\ApiContext;

$addr = new Address();
$addr->setLine1("80 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("ZAR")
    ->setTotal(200.00);

// ### Ebucks
// A resource representing an ebucks that can be
// used to fund a payment.
$ebucks = new Ebucks();
$ebucks->setAction(Ebucks::AUTHENTICATE_ACCOUNT)
    ->setAuthenticateAccountType('EBUCKS')
    ->setEbucksMemberIdentifier('7908149412253')
    ->setEbucksPin('1969');

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$fi = new FundingInstrument();
$fi->setEbucks($ebucks);

$ci = new CustomerInfo();
$ci->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('john.snow@example.com')
    ->setCountryCode('27')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('858')
    ->setBillingAddress($addr);

// ### Customer
// A resource representing a Customer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_EBUCKS)
    ->setCustomerInfo($ci)
    ->setIPAddress('127.0.0.1')
    ->setFundingInstrument($fi);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid('payu'));

$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl("$baseUrl/process-return.php")
    ->setReturnUrl("$baseUrl/process-return.php?apiContext=1")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=1");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$payment = new Payment();
$payment->setIntent(Transaction::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setRedirectUrls($redirectUrls);

// Because default integration is redirect, setting integration to
// `enterprise` will alter the way the API behaves.
$apiContext[1]->setAccountId('acct2')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the payment->create() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The returned object contains the state as well as other details of the
// transaction.
try {
    $payment->create($apiContext[1]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Create Payment Using eBucks. If 500 Exception, check the details of the response', 'Payment', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Create Payment Using eBucks', 'Payment', $payment->getId(), $request, $payment);

return $payment;
