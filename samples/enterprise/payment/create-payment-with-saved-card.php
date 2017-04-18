<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

$card = require __DIR__ . '/../../safestore/create-credit-card.php';

$reference = $card->getReturn()->getMerchantReference();
$token = $card->getReturn()->getPaymentMethodsUsed()->getId();
$userId = $card->getCustomer()->getCustomerInfo()->getCustomerId();

use PayU\Api\Amount;
use PayU\Api\CreditCardToken;
use PayU\Api\Customer;
use PayU\Api\CustomerInfo;
use PayU\Api\FundingInstrument;
use PayU\Api\Payment;
use PayU\Api\Transaction;
use PayU\Soap\ApiContext;


// ### CreditCardToken
// Saved credit card id from a previous call to
// create-credit-card.php
$creditCardToken = new CreditCardToken();
$creditCardToken->setCreditCardId($token)
    ->setCvv2('123');

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For stored credit card payments, set the CreditCardToken
// field on this object.
$fi = new FundingInstrument();
$fi->setCreditCardToken($creditCardToken);

$ci = new CustomerInfo();
$ci->setCustomerId($userId);

// ### Customer
// A resource representing a Customer that funds a payment
// For stored credit card payments, set payment method
// to 'credit_card'.
$customer = new Customer();
$customer->setCustomerInfo($ci)
    ->setFundingInstrument($fi);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("ZAR")
    ->setTotal(100.00);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription("Payment description")
    ->setInvoiceNumber($reference);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
$payment = new Payment();
$payment->setIntent(Transaction::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction);

// Setting integration will alter the way the API behaves.
$apiContext[6]->setAccountId('acct7')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $payment;

// ###Create Payment
// Create a payment by calling the 'callDoTransaction' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state.
try {
    $payment->create($apiContext[6]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Create Payment using Saved Credit Card", "Payment", null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Create Payment using Saved Credit Card", "Payment", $payment->getReturn()->getPayUReference(), $request, $payment);

return $payment;