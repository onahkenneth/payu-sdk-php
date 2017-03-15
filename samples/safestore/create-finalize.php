<?php
// # Capture Payment
// This sample code demonstrates how you can capture a payment.

$createdReserve = require 'create-reserve.php';

use PayU\Api\Amount;
use PayU\Api\Customer;
use PayU\Api\Reserve;
use PayU\Api\PaymentMethod;
use PayU\Api\Transaction;


$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD);

$amount = new Amount();
$amount->setCurrency("ZAR")
    ->setTotal(200.00);

$transaction = new Transaction();
$transaction->setAmount($amount);

$reserve = new Reserve();
$response = $createdReserve->getReturn();
// Setting intent to finalize captures the authorized payment.
$reserve->setIntent(Transaction::TYPE_FINALIZE)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setPayUReference($response->getPayUReference())
    ->setMerchantReference($response->getMerchantReference());

// For Sample Purposes Only.
$request = clone $reserve;

// ### Capture Payment
// Capture a payment by calling the reserve->capture() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The response object retrieved by calling `getReturn()` on the payment resource contains the state.
try {
    $capture = $reserve->capture($apiContext);

} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Finalize a Payment', 'Finalized Payment', $reserve->getId(), $reserve, $ex);
    exit(1);
}

return $capture;
