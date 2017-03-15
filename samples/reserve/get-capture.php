<?php
// # Get Capture
// This sample code demonstrates how you can get details of a captured payment.

$capture = require __DIR__ . '/../safestore/create-finalize.php';
$reference = $capture->getReturn()->getPayUReference();

use PayU\Api\Capture;


// For Sample Purposes Only.
$request = clone $capture;

// You can retrieve info about a Capture (Finalize)
// by invoking the Capture::get method
// with a valid ApiContext (See bootstrap.php for more on <code>ApiContext</code>).
try {
    $response = Capture::get($reference, $apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Get Finalize Details', 'Finalized Details', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Get Finalize Details', 'Finalized Details', $reference, $request, $response);

return $response;
