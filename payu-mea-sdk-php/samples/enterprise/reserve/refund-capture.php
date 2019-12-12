<?php
// # Authorize Payment
// This sample code demonstrates how you can authorize a payment and get it's details.

$capture = require __DIR__ . '/../../safestore/create-finalize.php';
$captureId = $capture->getId();

use PayU\Api\Amount;
use PayU\Api\Transaction;
use PayU\Soap\ApiContext;

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
$transaction->setAmount($amount);

$capture->setIntent(Transaction::TYPE_CREDIT)
    ->setTransaction($transaction);

// Setting integration will alter the way the API behaves.
$apiContext[0]->setAccountId('acct1')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $capture;

// You can refund a payment amount by invoking the `refund` method
// with a valid ApiContext (See bootstrap.php for more on <code>ApiContext</code>).
try {
    $refund = $capture->refund($apiContext[0]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Refund Captured/Finalized Payment', 'Refund', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Refund Captured/Finalized Payment', 'Refund', $captureId, $request, $refund);

return $refund;
