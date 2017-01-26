<?php
/**
 * PayU EMEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Model\PayUModel;

/**
 * Class PaymentExecution
 *
 * Let's you execute a PayU Account based Payment resource with the payer_id obtained from web approval url.
 *
 * @package PayU\Api
 *
 * @property string payer_id
 * @property \PayU\Api\Transaction[] transactions
 */
class PaymentExecution extends PayUModel
{

}
