<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../../bootstrap.php';

use PayU\Api\Address;
use PayU\Api\Amount;
use PayU\Api\CreditCard;
use PayU\Api\Customer;
use PayU\Api\CustomerInfo;
use PayU\Api\FmDetails;
use PayU\Api\FundingInstrument;
use PayU\Api\Item;
use PayU\Api\ItemList;
use PayU\Api\Payment;
use PayU\Api\PaymentCard;
use PayU\Api\PaymentMethod;
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

// ### CreditCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new CreditCard();
$card->setType(PaymentCard::TYPE_VISA)
    ->setNumber("4000015372250142")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("123")
    ->setFirstName("John")
    ->setLastName("Snow")
    ->setBillingAddress($addr)
    ->setBillingCountry("ZA");

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$fi = new FundingInstrument();
$fi->setPaymentCard($card);

// ### CustomerInfo
// A resource representing a customer detailed information
$ci = new CustomerInfo();
$ci->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('john.snow@example.com')
    ->setCountryCode('27')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('854')
    ->setBillingAddress($addr);

// ### Customer
// A resource representing a Customer that funds a payment
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD)
    ->setFundingInstrument($fi)
    ->setCustomerInfo($ci)
    ->setIPAddress('127.0.0.1');

// ### Itemized information
// (Optional) Lets you specify item wise
// information. Only Utilized with fraud management enabled, otherwise ignored.
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
$si->setId(25)
    ->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('john.snow@example.com')
    ->setPhone('0748523695')
    ->setMethod('P')
    ->setShippingAddress($addr);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("ZAR")
    ->setTotal(175.50);

// ### Fraud Management Details
// Lets you specify details required for fraud management.
$fm = new FmDetails();
$fm->setCheckFraudOverride(false)
    ->setMerchantWebsite(getBaseUrl())
    ->setPCFingerPrint('owhjiflkwhefqwoaef');

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
    ->setShippingInfo($si);

$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl("$baseUrl/process-ipn");

// ### Redirect
// A Redirect Payment Resource; create one using
// the above types and intent set to sale 'payment'
$payment = new Payment();
$payment->setIntent(Transaction::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setRedirectUrls($redirectUrls);

// Setting integration will alter the way the API behaves.
$apiContext[2]->setAccountId('acct3')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the payment->callSetTransaction method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return object contains the result with the redirect url to PayU to capture customer's payment details.
try {
    $payment->create($apiContext[2]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Create Payment with Fraud Management. If 500 Exception, check response for details.', 'Payment', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Create Payment with Fraud Management', 'Payment', $payment->getId(), $request, $payment);

return $payment;
