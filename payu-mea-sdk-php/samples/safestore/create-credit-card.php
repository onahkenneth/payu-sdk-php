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
use PayU\Api\FundingInstrument;
use PayU\Api\Payment;
use PayU\Api\PaymentCard;
use PayU\Api\PaymentMethod;
use PayU\Api\RedirectUrls;
use PayU\Api\Transaction;
use PayU\Soap\ApiContext;

// ### PaymentCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new PaymentCard();
$card->setType(PaymentCard::TYPE_MASTERCARD)
    ->setNumber("5100011063555010")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("123")
    ->setFirstName("John")
    ->setBillingCountry("ZA")
    ->setLastName("Snow");

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$fi = new FundingInstrument();
$fi->setPaymentCard($card)
    ->setStoreCard(true);

$addr = new Address();
$addr->setLine1('21 Main Road')
    ->setLine2('Cape Town')
    ->setCity('Cape Town')
    ->setState('WC')
    ->setPostalCode('2000')
    ->setCountryCode('ZA');

$ci = new CustomerInfo();
$ci->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('test.customer@example.com')
    ->setCountryOfResidence('ZA')
    ->setCountryCode('27')
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

$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl("$baseUrl/process-ipn");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'reserve'
$payment = new Payment();
$payment->setIntent(Transaction::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setRedirectUrls($redirectUrls);

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[6]->setAccountId('acct7')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the payment->callDoTransaction method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The response object retrieved by calling `getReturn` on the payment object contains the state.
try {
    $card = $payment->create($apiContext[6]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Create Payment and Save Credit Card", "Payment", null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Create Payment and Save Credit Card', 'Payment', $card->getId(), $request, $card);

return $card;
