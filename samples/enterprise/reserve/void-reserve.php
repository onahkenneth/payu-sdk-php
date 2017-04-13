<?php
// # Void Authorize
// This sample code demonstrates how you can authorize a payment and get it's details.

$reserve = require __DIR__ . '/../../safestore/create-reserve.php';
$reserveId = $reserve->getId();

use PayU\Api\Transaction;
use PayU\Soap\ApiContext;

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[0]->setAccountId('acct1')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $reserve;

$reserve->setIntent(Transaction::TYPE_RESERVE_CANCEL);


// You can retrieve info about an Authorization (Reserve)
// by invoking the Reserve::get method
// with a valid ApiContext (See bootstrap.php for more on <code>ApiContext</code>).
try {
    $resource = $reserve->void($apiContext[0]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Void/Cancel Authorized/Reserved Payment', 'Reserve', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Void/Cancel Authorized/Reserved Payment', 'Reserve', $reserveId, $request, $resource);

return $resource;
