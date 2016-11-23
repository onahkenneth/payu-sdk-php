<?php

namespace PayU;

/**
 * PayU PHP SDK Library
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class Transaction
{
    const STATE_NEW = 'NEW';
    const STATE_PROCESSING = 'PROCESSING';
    const STATE_CANCELED = 'CANCELED';
    const STATE_FAILED = 'FAILED';
    const STATE_SUCCESS = 'SUCCESS';
    const STATE_AWAITING_PAYMENT = 'AWAITING_PAYMENT';

    const TYPE_PAYMENT = 'PAYMENT';
    const TYPE_RESERVE = 'RESERVE';
}