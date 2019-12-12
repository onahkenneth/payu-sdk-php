<?php

namespace PayU\Handler;

/**
 * Class PayUHandler
 *
 * @package PayU\Handler
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
interface PayUHandler
{
    /**
     *
     * @param \PayU\Http\Config $httpConfig
     * @param string $request
     * @param mixed $options
     * @return mixed
     */
    public function handle($httpConfig, $request, $options);
}
