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
use PayU\Api\EFTPro;
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

// ### Eft
// A resource representing an eft that can be
// used to fund a payment.

$eftPro = new EFTPro();
$eftPro->setAmount($amount->getTotal());

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
$fi = new FundingInstrument();
$fi->setEft($eftPro);

$ci = new CustomerInfo();
$ci->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setCountryCode('27')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('858')
    ->setBillingAddress($addr);

// ### Customer
// A resource representing a Customer that funds a payment.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_EFT_PRO)
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
// A Payment Resource; create one with intent set to 'payment'
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
    ResultPrinter::printError('Create Payment Using EFT Pro. If 500 Exception, check response for details.', 'Payment', null, $request, $ex);
    exit(1);
}

$url = $payment->getEftProUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Create Payment Using EFT Pro. Please visit the URL to choose your bank.', 'Payment', "<a href='$url' >$url</a>", $request, $payment);

return $payment;
