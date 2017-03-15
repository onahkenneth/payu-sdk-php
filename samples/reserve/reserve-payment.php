<?php
// # Authorize Payment
// This sample code demonstrates how you can authorize a payment.

require __DIR__ . '/../bootstrap.php';

use PayU\Api\Address;
use PayU\Api\Amount;
use PayU\Api\Customer;
use PayU\Api\CustomerInfo;
use PayU\Api\FundingInstrument;
use PayU\Api\Reserve;
use PayU\Api\PaymentCard;
use PayU\Api\PaymentMethod;
use PayU\Api\RedirectUrls;
use PayU\Api\Transaction;

// The biggest difference between creating a payment, and authorizing a payment is to set the intent of payment
// to correct setting. In this case, it would be 'reserve'
$addr = new Address();
$addr->setLine1("3909 Witmer Road")
    ->setLine2("Niagara Falls")
    ->setCity("Niagara Falls")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

$paymentCard = new PaymentCard();
$paymentCard->setType(PaymentCard::TYPE_MASTERCARD)
    ->setNumber("5100011063555010")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("123")
    ->setFirstName("Joe")
    ->setLastName("Soap")
    ->setBillingCountry("ZA")
    ->setBillingAddress($addr);

$fi = new FundingInstrument();
$fi->setPaymentCard($paymentCard);

$ci = new CustomerInfo();
$ci->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('854')
    ->setBillingAddress($addr);

$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD)
    ->setIpAddress('12.0.0.7')
    ->setFundingInstrument($fi)
    ->setCustomerInfo($ci);

$amount = new Amount();
$amount->setCurrency("ZAR")
    ->setTotal(100);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription("Payment description.")
    ->setInvoiceNumber(uniqid('payu'));

$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl('http://example.com/return');

$reserve = new Reserve();

// Setting intent to reserve creates a payment
// authorization. Setting it to payment creates actual payment
$reserve->setIntent(Transaction::TYPE_RESERVE)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setRedirectUrls($redirectUrls);

// For Sample Purposes Only.
$request = clone $reserve;

// ### Create Payment
// Create an authorization by calling the payment->callDoTransaction() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return/response object contains the various information about the payment.
try {
    $reserve->callDoTransaction($apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Reserve a Payment', 'Reserved Payment', $reserve->getId(), $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Reserve a Payment', 'Reserved Payment', $reserve->getReturn()->getPayUReference(), $request, $reserve);

return $reserve;
