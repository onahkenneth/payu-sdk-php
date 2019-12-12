<?php

// # CreateRedirectPaymentSample
//
// This sample code demonstrate how you can process
// a redirect payment.

require __DIR__ . '/../../bootstrap.php';

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
$addr->setLine1("21 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

// ### CustomerInfo
// A resource representing a customer detailed information
$ci = new CustomerInfo();
$ci->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setCountryCode('27')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('857')
    ->setBillingAddress($addr);

// ### Customer
// A resource representing a Customer that funds a payment.
$customer = new Customer();
$customer->setCustomerInfo($ci)
    ->setIPAddress('127.0.0.1');

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("NGN")
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
$redirectUrls->setNotifyUrl("$baseUrl/process-return.php")
    ->setReturnUrl("$baseUrl/process-return.php?apiContext=1")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=1");

// ### Redirect
// A Redirect Payment Resource; create one with intent set to 'payment'
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

// ### Setup redirect
// Setup redirect payment by calling the redirect->setup() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// `getPayURedirectUrl` will return the url for redirection.
try {
    $redirect->setup($apiContext[1]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Setup Redirect Payment. If 500 Exception, check response for details.', 'Redirect', null, $request, $ex);
    exit(1);
}

$rppUrl = $redirect->getPayURedirectUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Setup Redirect Payment. Please visit the URL to Capture your payment details.", "Redirect", "<a href='$rppUrl' >$rppUrl</a>", $request, $redirect);


return $redirect;
