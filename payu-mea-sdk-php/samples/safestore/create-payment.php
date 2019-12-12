<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../bootstrap.php';

use PayU\Api\Address;
use PayU\Api\Amount;
use PayU\Api\Customer;
use PayU\Api\CustomerInfo;
use PayU\Api\Details;
use PayU\Api\FundingInstrument;
use PayU\Api\Item;
use PayU\Api\ItemList;
use PayU\Api\Payment;
use PayU\Api\PaymentCard;
use PayU\Api\PaymentMethod;
use PayU\Api\RedirectUrls;
use PayU\Api\Transaction;
use PayU\Soap\ApiContext;

$addr = new Address();
$addr->setLine1("3909 Witmer Road")
    ->setLine2("Niagara Falls")
    ->setCity("Niagara Falls")
    ->setState("GP")
    ->setPostalCode("14305")
    ->setCountryCode("ZA");

// ### PaymentCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new PaymentCard();
$card->setType(PaymentCard::TYPE_VISA)
    ->setNumber("4000015372250142")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("123")
    ->setFirstName("John")
    ->setBillingCountry("ZA")
    ->setLastName("Snow")
    ->setBillingAddress($addr);

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$fi = new FundingInstrument();
$fi->setPaymentCard($card);

$ci = new CustomerInfo();
$ci->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('854')
    ->setBillingAddress($addr);

// ### Customer
// A resource representing a Customer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD)
    ->setCustomerInfo($ci)
    ->setIpAddress('127.0.0.1')
    ->setFundingInstrument($fi);

// ### Itemized information
// (Optional) Lets you specify item wise
// information
$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setDescription('Ground Coffee 40 oz')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setTax(0.3)
    ->setPrice(7.50);
$item2 = new Item();
$item2->setName('Granola bars')
    ->setDescription('Granola Bars with Peanuts')
    ->setCurrency('USD')
    ->setQuantity(5)
    ->setTax(0.2)
    ->setPrice(2);

$itemList = new ItemList();
$itemList->setItems(array($item1, $item2));

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
$details = new Details();
$details->setShipping(1.2)
    ->setTax(1.3)
    ->setSubtotal(17.5);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("ZAR")
    ->setTotal(200.00)
    ->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid('payu'));

$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl('http://example.com/return');

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$payment = new Payment();
$payment->setIntent(Transaction::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setRedirectUrls($redirectUrls);

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[6]->setAccountId('acct7')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the payment->doTransaction method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The response object retrieved by calling `getReturn` on the payment object contains the state.
try {
    $payment->create($apiContext[6]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Create Payment With Credit Card. If 500 Exception, check response details', 'Payment', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Create Payment With Credit Card", "Payment", $payment->getId(), $request, $payment);

return $payment;