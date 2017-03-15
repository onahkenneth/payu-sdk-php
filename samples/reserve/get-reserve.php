<?php
// # Authorize Payment
// This sample code demonstrates how you can authorize a payment and get it's details.

$reserve = require __DIR__ . '/../safestore/create-reserve.php';
$reference = $reserve->getReturn()->getPayUReference();

use PayU\Api\Reserve;


// For Sample Purposes Only.
$request = clone $reserve;

// You can retrieve info about an Authorization (Reserve)
// by invoking the Reserve::get method
// with a valid ApiContext (See bootstrap.php for more on <code>ApiContext</code>).
try {
    $response = Reserve::get($reference, $apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Get Reserve Details', 'Reserved Details', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Get Reserve Details', 'Reserved Details', $reference, $request, $response);

return $response;
