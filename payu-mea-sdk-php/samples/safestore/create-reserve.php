<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../bootstrap.php';

use PayU\Api\Amount;
use PayU\Api\Customer;
use PayU\Api\CustomerInfo;
use PayU\Api\FundingInstrument;
use PayU\Api\InvoiceAddress;
use PayU\Api\PaymentCard;
use PayU\Api\PaymentMethod;
use PayU\Api\RedirectUrls;
use PayU\Api\Reserve;
use PayU\Api\Transaction;
use PayU\Soap\ApiContext;

// ### PaymentCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new PaymentCard();
$card->setType(PaymentCard::TYPE_VISA)
    ->setNumber("4000019542438801")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("123")
    ->setFirstName("John")
    ->setLastName("Snow")
    ->setBillingCountry("ZA");

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$fi = new FundingInstrument();
$fi->setPaymentCard($card)
    ->setStoreCard(true);

$inv_addr = new InvoiceAddress();
$inv_addr->setLine1('123 ABC Street')
    ->setCity('Johannesburg')
    ->setState('Gauteng')
    ->setPostalCode('2000');

$ci = new CustomerInfo();
$ci->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('854')
    ->setBillingAddress($inv_addr);

// ### Customer
// A resource representing a Customer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
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
    ->setTotal(175.50);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid('payu'));

$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl('http://example.com/return');

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$reserve = new Reserve();
$reserve->setIntent(Transaction::TYPE_RESERVE)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setRedirectUrls($redirectUrls);

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[0]->setAccountId('acct1')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $reserve;

// ### Create Payment
// Create a payment by calling the payment->callDoTransaction method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The response object retrieved by calling `getReturn()` on the payment resource the contains the state.
try {
    $reserve->create($apiContext[0]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Create Authorized/Reserved Payment", "Reserve", null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Create Authorized/Reserved Payment", "Reserve", $reserve->getId(), $request, $reserve);

return $reserve;
