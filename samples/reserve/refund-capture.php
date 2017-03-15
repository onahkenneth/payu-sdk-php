<?php
// # Authorize Payment
// This sample code demonstrates how you can authorize a payment and get it's details.

$capture = require __DIR__ . '/../safestore/create-finalize.php';
$reference = $capture->getReturn()->getPayUReference();

use PayU\Api\Amount;
use PayU\Api\Transaction;

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
$transaction->setAmount($amount);

$capture->setIntent(Transaction::TYPE_CREDIT)
    ->setTransaction($transaction);


// For Sample Purposes Only.
$request = clone $capture;

// You can retrieve info about an Authorization (Reserve)
// by invoking the Reserve::get method
// with a valid ApiContext (See bootstrap.php for more on <code>ApiContext</code>).
try {
    $refund = $capture->refund($apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Refund Capture', 'Refund', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Refund Capture', 'Refund', $reference, $request, $refund);

return $refund;
