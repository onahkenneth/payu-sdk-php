<?php

// # CreateRedirectPaymentSample
//
// This sample code demonstrate how you can process
// a redirect payment.

$payment = require __DIR__ . '/../safestore/create-credit-card.php';

use PayU\Api\LookupTransaction;

$payload = array(
    'lookupTransactionType' => 'TOKEN',
    'Customfield' => array(
        array(
            'key' => 'MerchantUserId',
            'value' => $payment->getCustomer()->getId(),
        ),
    ),
);

try {
    $response = LookupTransaction::lookup($payload, $apiContext[0]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Lookup Transactions. If 500 Exception, check response details', 'LookupTransaction', null, null, $ex);
    exit(1);
}

ResultPrinter::printResult('Lookup Transactions', 'LookupTransaction', $card->getId(), $payload, $response);

return $response;
