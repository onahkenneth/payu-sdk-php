<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

$card = require __DIR__ . '/../safestore/create-credit-card.php';

use PayU\Api\Amount;
use PayU\Api\CreditCardToken;
use PayU\Api\Customer;
use PayU\Api\Details;
use PayU\Api\FundingInstrument;
use PayU\Api\Item;
use PayU\Api\ItemList;
use PayU\Api\Payment;
use PayU\Api\Transaction;

// ### Credit card token
// Saved credit card id from a previous call to
// CreateCreditCard.php
$creditCardToken = new CreditCardToken();
$creditCardToken->setCreditCardId($card->getId());

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For stored credit card payments, set the CreditCardToken
// field on this object.
$fi = new FundingInstrument();
$fi->setCreditCardToken($creditCardToken)
    ->setStoreCard(false);

// ### Customer
// A resource representing a Customer that funds a payment
// For stored credit card payments, set payment method
// to 'credit_card'.
$customer = new Customer();
$customer->setPaymentMethod("credit_card")
    ->setFundingInstrument($fi);

// ### Itemized information
// (Optional) Lets you specify item wise
// information
$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setCurrency('ZAR')
    ->setQuantity(1)
    ->setPrice(7.5);
$item2 = new Item();
$item2->setName('Granola bars')
    ->setCurrency('ZAR')
    ->setQuantity(5)
    ->setPrice(2);

$itemList = new ItemList();
$itemList->setItems(array($item1, $item2));

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
$details = new Details();
$details->setShipping(1.2)
    ->setTax(1.3)
    ->setSubtotal(17.5);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("ZAR")
    ->setTotal(20)
    ->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid('payu'));

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
$payment = new Payment();
$payment->setIntent("payment")
    ->setCustomer($customer)
    ->setTransaction($transaction);


// For Sample Purposes Only.
$request = clone $payment;
// ###Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state.
try {
    $payment->callDoTransaction($apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Create Payment using Saved Card", "Payment", null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Create Payment using Saved Card", "Payment", $payment->getId(), $request, $payment);

return $card;