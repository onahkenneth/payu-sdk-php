<?php
// # LookupPaymentSample
// This sample code demonstrate how you can
// retrieve details of a Payment resource
// you've created using the SOAP API.

/** @var Redirect $createdRedirect */
$createdRedirect = require __DIR__ . '/../safestore/setup-standard-redirect.php';

use PayU\Api\Redirect;

$redirectId = $createdRedirect->getId();

// ### Retrieve payment
// Retrieve the Redirect resource object by calling the
// static `get` method on the Redirect class by passing a valid Redirect ID (PayU reference).
// (See bootstrap.php for more on `ApiContext`)
try {
    $response = Redirect::get($redirectId, $apiContext[1]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Get Redirect Authorize/Reserve details", "Redirect", null, null, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Get Redirect Authorize/Reserve details", "Redirect", $redirectId, $createdRedirect, $response);

return $response;
