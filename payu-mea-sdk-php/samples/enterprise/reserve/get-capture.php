<?php
// # Get Capture
// This sample code demonstrates how you can get details of a captured payment.

$capture = require __DIR__ . '/../../safestore/create-finalize.php';
$captureId = $capture->getId();

use PayU\Api\Capture;
use PayU\Soap\ApiContext;

// Setting integration will alter the way the API behaves.
$apiContext[0]->setAccountId('acct1')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $capture;

// You can retrieve info about a Capture (Finalize)
// by invoking the Capture::get method
// with a valid ApiContext (See bootstrap.php for more on <code>ApiContext</code>).
try {
    $response = Capture::get($captureId, $apiContext[0]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Get Captured/Finalized Payment Details', 'Capture', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Get Captured/Finalized Payment Details', 'Capture', $captureId, $request, $response);

return $response;
