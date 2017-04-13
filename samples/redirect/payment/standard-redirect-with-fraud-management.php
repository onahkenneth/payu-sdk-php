<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../../bootstrap.php';

use PayU\Api\Address;
use PayU\Api\Amount;
use PayU\Api\Customer;
use PayU\Api\CustomerInfo;
use PayU\Api\FmDetails;
use PayU\Api\Item;
use PayU\Api\ItemList;
use PayU\Api\Redirect;
use PayU\Api\RedirectUrls;
use PayU\Api\ShippingInfo;
use PayU\Api\Transaction;
use PayU\Soap\ApiContext;

// ### Address
// A resource representing a customer shipping/billing address information
$addr = new Address();
$addr->setLine1("80 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

// ### CustomerInfo
// A resource representing a customer detailed information
$ci = new CustomerInfo();
$ci->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('john.snow@example.com')
    ->setCountryCode('27')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('856')
    ->setBillingAddress($addr);

// ### Customer
// A resource representing a Customer that funds a payment
$customer = new Customer();
$customer->setCustomerInfo($ci)
    ->setIpAddress('127.0.0.1');

// ### Itemized information
// Lets you specify item wise information.
// Utilized with fraud management enabled, otherwise ignored.
$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setDescription('Ground Coffee 40 oz')
    ->setSku('GCF0011')
    ->setCurrency('ZAR')
    ->setQuantity(10)
    ->setTax(0.3)
    ->setPrice(7.50);
$item2 = new Item();
$item2->setName('Granola bars')
    ->setDescription('Granola Bars with Peanuts')
    ->setSku('GCF0022')
    ->setCurrency('ZAR')
    ->setQuantity(5)
    ->setTax(0.2)
    ->setPrice(20);

$itemList = new ItemList();
$itemList->setItems(array($item1, $item2));

// ### ShippingInfo
// Use this optional field to set shipping information.
$si = new ShippingInfo();
$si->setId('28')
    ->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setPhone('0748523695')
    ->setMethod('W')
    ->setShippingAddress($addr);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("ZAR")
    ->setTotal(175.50);

$fm = new FmDetails();
$fm->setCheckFraudOverride(false)
    ->setMerchantWebsite(getBaseUrl())
    ->setPcFingerPrint('owhjiflkwhefqwoaef');

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid('payu'))
    ->setFraudManagement($fm)
    ->setShippingInfo($si)
    ->setShowBudget(false);

$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl("$baseUrl/process-return.php")
    ->setReturnUrl("$baseUrl/process-return.php?apiContext=2")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=2");

// ### Redirect
// A Redirect Payment Resource; create one using
// the above parameters and intent set to 'payment'
$redirect = new Redirect();
$redirect->setIntent(Transaction::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setRedirectUrls($redirectUrls);

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[2]->setAccountId('acct3')
    ->setIntegration(ApiContext::REDIRECT);

// For Sample Purposes Only.
$request = clone $redirect;

// ### Create Redirect
// Create a Redirect by calling the payment->init() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return object contains the result.
try {
    $redirect->setup($apiContext[2]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Setup Redirect With Fraud Management. If 500 Exception, check return object for details', 'Redirect', null, $request, $ex);
    exit(1);
}

$rppUrl = $redirect->getPayURedirectUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Setup Redirect Payment With Fraud Management. Please visit the URL to Capture your payment details.", "Redirect", "<a href='$rppUrl' >$rppUrl</a>", $request, $redirect);


return $redirect;
