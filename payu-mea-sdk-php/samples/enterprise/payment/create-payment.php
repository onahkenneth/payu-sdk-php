<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

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
use PayU\Soap\ApiContext;

$addr = new Address();
$addr->setLine1("80 Main Road")
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

$ci = new CustomerInfo();
$ci->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('test.customer@example.com')
    ->setCountryCode('27')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('854')
    ->setBillingAddress($addr);

// ### Customer
// A resource representing a Customer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD)
    ->setCustomerInfo($ci)
    ->setIPAddress('127.0.0.1')
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

$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl("$baseUrl/process-ipn");

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
$apiContext[6]->setAccountId('acct7')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the payment->doTransaction method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return object contains the state.
try {
    $payment->create($apiContext[6]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Create Payment Using Credit Card. If 500 Exception, try creating a new Credit Card', 'Payment', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Create Payment Using Credit Card', 'Payment', $payment->getId(), $request, $payment);

return $payment;
