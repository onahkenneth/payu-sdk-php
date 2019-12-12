<?php

// # CreateRedirectPaymentSample
//
// This sample code demonstrate how you can process
// a redirect payment process.

require __DIR__ . '/../bootstrap.php';

use PayU\Api\Address;
use PayU\Api\Amount;
use PayU\Api\Customer;
use PayU\Api\CustomerInfo;
use PayU\Api\Redirect;
use PayU\Api\RedirectUrls;
use PayU\Api\Transaction;
use PayU\Soap\ApiContext;

// ### Address
// A resource representing a customer shipping/billing address information
$addr = new Address();
$addr->setLine1("3909 Witmer Road")
    ->setLine2("Niagara Falls")
    ->setCity("Niagara Falls")
    ->setState("GP")
    ->setPostalCode("14305")
    ->setCountryCode("ZA");

// ### CustomerInfo
// A resource representing a customer detailed information
$ci = new CustomerInfo();
$ci->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('855')
    ->setBillingAddress($addr);

// ### Customer
// A resource representing a Customer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$customer = new Customer();
$customer->setCustomerInfo($ci)
    ->setIPAddress('127.0.0.1');

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

$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl("$baseUrl/process-ipn.php")
    ->setReturnUrl("$baseUrl/process-return.php")
    ->setCancelUrl("$baseUrl/process-cancel.php");

// ### Redirect
// A Redirect Payment Resource; create one using
// the above types and intent set to sale 'payment'
$redirect = new Redirect();
$redirect->setIntent(Transaction::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setRedirectUrls($redirectUrls);

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[1]->setAccountId('acct2')
    ->setIntegration(ApiContext::REDIRECT);

// For Sample Purposes Only.
$request = clone $redirect;

// ### Create Payment
// Create a payment by calling the payment->callSetTransaction method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return object contains the state.
try {
    $redirect->setup($apiContext[1]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Setup Redirect Payment. If 500 Exception, check response details', 'Redirect', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Setup Redirect Payment", "Redirect", $redirect->getId(), $request, $redirect);

return $redirect;

