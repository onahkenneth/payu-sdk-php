<?php
// # Void Authorize
// This sample code demonstrates how you can authorize a payment and get it's details.

$reserve = require __DIR__ . '/../safestore/create-reserve.php';
$reference = $reserve->getReturn()->getPayUReference();

use PayU\Api\Transaction;

$reserve->setIntent(Transaction::TYPE_RESERVE_CANCEL);

// For Sample Purposes Only.
$request = clone $reserve;

// You can retrieve info about an Authorization (Reserve)
// by invoking the Reserve::get method
// with a valid ApiContext (See bootstrap.php for more on <code>ApiContext</code>).
try {
    $response = $reserve->void($apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Void Reserve', 'Void', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Void Reserve', 'Void', $reference, $request, $response);

return $response;
