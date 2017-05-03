<?php
// # Capture Payment
// This sample code demonstrates how you can capture an authorize payment.

$createdReserve = require __DIR__ . '/../../safestore/create-reserve.php';

use PayU\Api\Amount;
use PayU\Api\Customer;
use PayU\Api\PaymentMethod;
use PayU\Api\Reserve;
use PayU\Api\Transaction;
use PayU\Soap\ApiContext;

$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD);

$amount = new Amount();
$amount->setCurrency("ZAR")
    ->setTotal(175.50);

$transaction = new Transaction();
$transaction->setAmount($amount);

// Setting intent to finalize captures the authorized payment.
$reserve = new Reserve();
$response = $createdReserve->getReturn();
$reserve->setIntent(Transaction::TYPE_FINALIZE)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setPayUReference($response->getPayUReference())
    ->setMerchantReference($response->getMerchantReference());

// Setting integration will alter the way the API behaves.
$apiContext[0]->setAccountId('acct1')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $reserve;

// ### Capture Payment
// Create a payment by calling the reserve->create() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The response object retrieved by calling `getReturn()` on the payment resource contains the state.
try {
    $capture = $reserve->capture($apiContext[0]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Capture/Finalize Reserved Payment', 'Capture', $reserve->getId(), $reserve, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Capture/Finalize Reserved Payment', 'Capture', $capture->getId(), $request, $capture);

return $capture;
