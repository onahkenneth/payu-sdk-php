<?php

// # CreateDebitOrderSample
//
// This sample code demonstrate how you can process
// a debit order.

require __DIR__ . '/../../bootstrap.php';

use PayU\Api\Address;
use PayU\Api\Amount;
use PayU\Api\Customer;
use PayU\Api\CustomerInfo;
use PayU\Api\Redirect;
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

// ### CustomerInfo
// A resource representing a customer detailed information
$ci = new CustomerInfo();
$ci->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@gmail.com')
    ->setCountryCode('27')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('854')
    ->setBillingAddress($addr);

// ### Customer
// A resource representing a Customer that funds a payment.
$customer = new Customer();
$customer->setCustomerInfo($ci)
    ->setIpAddress('127.0.0.1');

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
    ->setManagedBy('PAYU')
    ->setFrequency('W');

$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl("$baseUrl/process-return.php")
    ->setReturnUrl("$baseUrl/process-return.php?apiContext=3")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=3");


// ### Redirect
// A Redirect Payment Resource; create with intent set to 'debit_order'
$redirect = new Redirect();
$redirect->setIntent(Transaction::TYPE_DEBIT_ORDER)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setRedirectUrls($redirectUrls)
    ->setTransactionRecord($transactionRecord);

// Redirect API integration.
$apiContext[3]->setAccountId('acct4')
    ->setIntegration(ApiContext::REDIRECT);

// For Sample Purposes Only.
$request = clone $redirect;

// ### Setup Redirect Debit Order
// Setup redirect by calling the redirect->setup() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// `getPayURedirectUrl` will return the url for redirection.
try {
    $redirect->setup($apiContext[3]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Setup Debit Order. If 500 Exception, check response for details', 'Redirect', null, $request, $ex);
    exit(1);
}

$rppUrl = $redirect->getPayURedirectUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Setup Debit Order. Please visit the URL to complete setup.", "Redirect", "<a href='$rppUrl' >$rppUrl</a>", $request, $redirect);


return $redirect;
