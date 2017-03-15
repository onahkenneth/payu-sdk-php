<?php

namespace PayU\Http;

/**
 * Class ConnectionInterface
 *
 * @package PayU\Http
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
interface ConnectionInterface
{
    /**
     * @param string $method The SOAP method to call
     * @param string $data The HTTP POST data
     */
    public function execute($method, $data);
}
