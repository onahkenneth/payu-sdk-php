<?php
// # Authorize Payment
// This sample code demonstrates how you can authorize a payment and get it's details.

$reserve = require __DIR__ . '/../../safestore/create-reserve.php';
$reserveId = $reserve->getId();

use PayU\Api\Reserve;
use PayU\Soap\ApiContext;

// Setting integration will alter the way the API behaves.
$apiContext[0]->setAccountId('acct1')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $reserve;

// You can retrieve info about an Authorization (Reserve)
// by invoking the Reserve::get method
// with a valid ApiContext (See bootstrap.php for more on <code>ApiContext</code>).
try {
    $resource = Reserve::get($reserveId, $apiContext[0]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Get Authorized/Reserved Payment Details', 'Reserve', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Get Authorized/Reserved Payment Details', 'Reserve', $reserveId, $request, $resource);

return $resource;
