<?php
// # LookupPaymentSample
// This sample code demonstrate how you can
// retrieve details of a Payment resource
// you've created using the SOAP API.

/** @var Payment $createdPayment */
$createdPayment = require __DIR__ . '/../safestore/create-payment.php';

use PayU\Api\Payment;

$paymentReference = $createdPayment->getReturn()->getPayUReference();

// ### Retrieve payment
// Retrieve the payment object by calling the
// static `callGetTransaction` method
// on the Payment class by passing a valid PayU reference ID
// (See bootstrap.php for more on `ApiContext`)
try {
    $payment = Payment::get($paymentReference, $apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Lookup Payment details", "Payment", null, null, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Lookup Payment details", "Payment", $payment->getReturn()->getPayUReference(), $createdPayment, $payment);

return $payment;
