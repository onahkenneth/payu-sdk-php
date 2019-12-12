<?php
// # LookupPaymentSample
// This sample code demonstrate how you can
// retrieve details of a Payment resource
// you've created using the SOAP API.

/** @var Payment $createdPayment */
$createdPayment = require __DIR__ . '/../../safestore/create-payment.php';

use PayU\Api\Payment;

$paymentId = $createdPayment->getId();

// ### Retrieve payment
// Retrieve details of a payment object by calling the
// static `get` method
// on the Payment class by passing a valid PayU reference ID
// (See bootstrap.php for more on `ApiContext`)
try {
    $resource = Payment::get($paymentId, $apiContext[6]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Get Payment details", "Payment", null, null, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Get Payment details", "Payment", $payment->getId(), $createdPayment, $resource);

return $resource;
