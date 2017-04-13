<?php

require __DIR__ . '/../../bootstrap.php';

use PayU\Api\Redirect;
use PayU\Api\Transaction;
use PayU\Model\XmlHelper;
use PayU\Soap\ApiContext;

$payuReference = isset($_GET['PayUReference']) ? $_GET['PayUReference'] : '';

if(!$payuReference)
    $payuReference = isset($_GET['payUReference']) ? $_GET['payUReference'] : '';

if($payuReference) {
    $apiContextId = isset($_GET['apiContext']) ? $_GET['apiContext'] : 1;
    $cancel = isset($_GET['cancel']) ? $_GET['cancel'] : false;
    if($cancel) {
        $response = Redirect::get($payuReference, $apiContext[$apiContextId]);
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        ResultPrinter::printResult("User Cancelled the Capturing of Payment Details", 'Redirect', $payuReference, null, $response);
        exit;
    }

    $response = Redirect::get($payuReference, $apiContext[$apiContextId]);

    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printResult("User Payment Details Captured.", 'Redirect', $payuReference, null, $response);

    $return = $response->return;
    if($return->successful && $return->transactionType == strtoupper(Transaction::TYPE_RESERVE)) {
        $redirect = require __DIR__ . '/../../safestore/do-finalize-on-return.php';

        $request = clone $redirect;

        $apiContext[$apiContextId]->setAccountId('acct'. ($apiContextId + 1))
            ->setIntegration(ApiContext::ENTERPRISE);

        $transaction = $redirect->getTransaction();
        $transaction->setInvoiceNumber($return->merchantReference);
        $redirect->setPayUReference($return->payUReference)
            ->setTransaction($transaction);

        try {
            $redirect->create($apiContext[$apiContextId]);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            ResultPrinter::printError('Do Finalize after Payment Details Captured. If 500 Exception, check response object for details', 'Redirect', null, $request, $ex);
            exit(1);
        }

        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        ResultPrinter::printResult("Do Finalize after Payment Details Captured.", "Redirect", "", $request, $redirect);

        return $redirect;
    }
} else {
    $xml = file_get_contents("php://input");
    $sxe = simplexml_load_string($xml);

    if(empty($sxe)) {
        http_response_code('500');
    }

    $ipnArray = XmlHelper::parseXMLToArray($sxe);

    if($ipnArray) {
        $baseUrl = getBaseUrl();
        file_put_contents('sample_ipn', json_encode($ipnArray));
        http_response_code('200');
    } else {
        http_response_code('500');
    }
}