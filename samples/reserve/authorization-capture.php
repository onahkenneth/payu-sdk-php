<?php
// # Authorize Payment
// This sample code demonstrates how you can authorize a payment.

require __DIR__ . '/../bootstrap.php';

use PayU\Api\Address;
use PayU\Api\Amount;
use PayU\Api\Customer;
use PayU\Api\FundingInstrument;
use PayU\Api\Payment;
use PayU\Api\PaymentCard;
use PayU\Api\Transaction;

// The biggest difference between creating a payment, and authorizing a payment is to set the intent of payment
// to correct setting. In this case, it would be 'authorize'
$addr = new Address();
$addr->setLine1("3909 Witmer Road")
    ->setLine2("Niagara Falls")
    ->setCity("Niagara Falls")
    ->setState("NY")
    ->setPostalCode("14305")
    ->setCountryCode("US")
    ->setPhone("716-298-1822");

$paymentCard = new PaymentCard();
$paymentCard->setType("visa")
    ->setNumber("4417119669820331")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("012")
    ->setFirstName("Joe")
    ->setLastName("Shopper")
    ->setBillingCountry("US")
    ->setBillingAddress($addr);

$fi = new FundingInstrument();
$fi->setPaymentCard($paymentCard);

$customer = new Customer();
$customer->setPaymentMethod("credit_card")
    ->setFundingInstrument($fi);

$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal(1);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription("Payment description.");

$payment = new Payment();

// Setting intent to authorize creates a payment
// authorization. Setting it to sale creates actual payment
$payment->setIntent("reserve")
    ->setCustomer($customer)
    ->setTransaction($transaction);

// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the payment->create() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return object contains the state.
try {
    $payment->callDoTransaction($apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Authorize a Payment', 'Authorized Payment', $payment->getId(), $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Authorize a Payment', 'Authorized Payment', $payment->getId(), $request, $payment);

$transactions = $payment->getTransaction();
$relatedResources = $transactions[0]->getRelatedResources();
$authorization = $relatedResources[0]->getAuthorization();

return $authorization;
