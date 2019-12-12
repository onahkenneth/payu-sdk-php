<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Model\ResourceModel;

/**
 * Class Payment
 *
 * Lets you create, process and manage payments.
 *
 * @package PayU\Api
 */
class Payment extends ResourceModel
{
    public function getEftProUrl()
    {
        return $this->return->redirect->url;
    }
}
