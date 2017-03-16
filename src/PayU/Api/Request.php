<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Model\PayUModel;
use PayU\Model\ResourceModel;

/**
 * Class Response
 *
 * Request class accepts a request payload and returns a re-formatted the payload
 *
 * @package PayU\Api
 */
class Request extends PayUModel
{

    /**
     * Re-formats a resource into a request payload
     *
     * @param ResourceModel $resource the payment resource
     *
     * @return array $payload transaction payload for SOAP API request
     */
    public static function reformatPayment(ResourceModel $resource)
    {
        $customer = $resource->customer;
        $transaction = $resource->transaction;
        $amount = $transaction->amount;
        $total = (int)$amount->total * 100;

        $payload = array(
            'TransactionType' => strtoupper($resource->intent),
            'AdditionalInformation' => array(
                'merchantReference' => $transaction->invoice_number,
            ),
            'Basket' => array(
                'currencyCode' => $amount->currency,
                'amountInCents' => $total,
                'description' => $transaction->description
            ),
        );

        if (isset($resource->redirect_urls)
            && null !== ($redirectUrls = $resource->redirect_urls)
        ) {
            $payload = array_merge_recursive($payload, array(
                'AdditionalInformation' => array(
                    'notificationUrl' => $redirectUrls->notify_url
                )));
        }

        if (isset($customer->customer_info)
            && null !== ($customerInfo = $customer->customer_info)
        ) {
            $payload = array_merge($payload, array('Customer' => array(
                'merchantUserId' => $customerInfo->customer_id,
                'countryOfResidence' => $customerInfo->country_of_residence,
                'email' => $customerInfo->email,
                'firstName' => $customerInfo->first_name,
                'lastName' => $customerInfo->last_name,
                'mobile' => $customerInfo->phone,
                'ip' => $customer->ip_address,
            )));
        }

        if (isset($customer->payment_method)
            && PaymentMethod::TYPE_CREDITCARD == $customer->payment_method
            && $card = $customer->funding_instrument->payment_card
        ) {
            $payload = array_merge($payload, array(
                'Creditcard' => array(
                    'amountInCents' => $total,
                    'cardExpiry' => $card->expire_month . $card->expire_year,
                    'cardNumber' => $card->number,
                    'cvv' => $card->cvv2,
                    'nameOnCard' => $card->first_name . ' ' . $card->last_name
                )
            ));
        }

        if (isset($customer->funding_instrument->store_card)
            && $customer->funding_instrument->store_card
        ) {
            $payload = array_merge($payload, array(
                'storePaymentMethod' => 'True',
            ));
        }
        if (isset($customer->funding_instrument->store_card)
            && !$customer->funding_instrument->store_card
        ) {
            $payload = array_merge($payload, array(
                'AuthenticationType' => 'HANDSHAKE',
            ));
        }

        return $payload;
    }

    /**
     * Re-formats a resource into a request payload
     *
     * @param ResourceModel $resource the payment resource
     *
     * @return array $payload transaction payload for SOAP API request
     */
    public static function reformatReserve(ResourceModel $resource)
    {
        $customer = $resource->customer;
        $transaction = $resource->transaction;
        $amount = $transaction->amount;
        $total = (int)$amount->total * 100;

        $payload = array(
            'TransactionType' => strtoupper($resource->intent),
            'AdditionalInformation' => array(
                'merchantReference' => $resource->merchant_reference,
                'payUReference' => $resource->payu_reference
            ),
            'Basket' => array(
                'currencyCode' => $amount->currency,
                'amountInCents' => $total
            ),
        );

        if (isset($customer->payment_method)
            && PaymentMethod::TYPE_CREDITCARD == $customer->payment_method
        ) {
            $payload = array_merge($payload, array(
                'Creditcard' => array(
                    'amountInCents' => $total
                )
            ));
        }

        return $payload;
    }
}
