<?php

require __DIR__ . '/../bootstrap.php';

use PayU\Api\Redirect;
use PayU\Model\XMLHelper;

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
    ResultPrinter::printResult("Redirected From PayU", 'Redirect', $payuReference, null, $response);

} else {
    $xml = file_get_contents("php://input");
    $sxe = simplexml_load_string($xml);

    if(empty($sxe)) {
        http_response_code('500');
    }

    $ipnArray = XMLHelper::parseXMLToArray($sxe);

    if($ipnArray) {
        $baseUrl = getBaseUrl();
        file_put_contents('sample_ipn', json_encode($ipnArray));
        http_response_code('200');
    } else {
        http_response_code('500');
    }
}