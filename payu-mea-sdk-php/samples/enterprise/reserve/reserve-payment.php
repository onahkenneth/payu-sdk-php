<?php
// # Authorize Payment
// This sample code demonstrates how you can authorize a payment.

require __DIR__ . '/../../bootstrap.php';

use PayU\Api\Address;
use PayU\Api\Amount;
use PayU\Api\CreditCard;
use PayU\Api\Customer;
use PayU\Api\CustomerInfo;
use PayU\Api\FundingInstrument;
use PayU\Api\PaymentCard;
use PayU\Api\PaymentMethod;
use PayU\Api\RedirectUrls;
use PayU\Api\Reserve;
use PayU\Api\Transaction;
use PayU\Soap\ApiContext;

// The biggest difference between creating a payment, and authorizing a payment is to set the intent of payment
// to correct setting. In this case, it would be 'reserve'
$addr = new Address();
$addr->setLine1("21 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

$creditCard = new CreditCard();
$creditCard->setType(PaymentCard::TYPE_MASTERCARD)
    ->setNumber("5100011063555010")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("123")
    ->setFirstName("Joe")
    ->setLastName("Soap")
    ->setBillingCountry("ZA")
    ->setBillingAddress($addr);

$fi = new FundingInstrument();
$fi->setPaymentCard($creditCard);

$ci = new CustomerInfo();
$ci->setFirstName('Joe')
    ->setLastName('Soap')
    ->setEmail('joe.soap@example.com')
    ->setCountryCode('27')
    ->setCountryOfResidence('ZA')
    ->setPhone('0748523695')
    ->setCustomerId('854')
    ->setBillingAddress($addr);

$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD)
    ->setIPAddress('127.0.0.1')
    ->setFundingInstrument($fi)
    ->setCustomerInfo($ci);

$amount = new Amount();
$amount->setCurrency("ZAR")
    ->setTotal(100);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription("Payment description.")
    ->setInvoiceNumber(uniqid('payu'));

$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setNotifyUrl("$baseUrl/process-ipn");

$reserve = new Reserve();

// Setting intent to reserve creates a payment
// authorization. Setting it to payment creates actual payment
$reserve->setIntent(Transaction::TYPE_RESERVE)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setRedirectUrls($redirectUrls);

// Setting integration will alter the way the API behaves.
$apiContext[0]->setAccountId('acct1')
    ->setIntegration(ApiContext::ENTERPRISE);

// For Sample Purposes Only.
$request = clone $reserve;

// ### Create Payment
// Create an authorization by calling the payment->callDoTransaction() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return/response object contains the various information about the payment.
try {
    $reserve->create($apiContext[0]);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Authorize/Reserve Payment', 'Reserve', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Authorize/Reserve Payment', 'Reserve', $reserve->getReturn()->getPayUReference(), $request, $reserve);

return $reserve;
