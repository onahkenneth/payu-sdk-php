<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/16/16
 * Time: 4:47 PM
 */

namespace PayU\Exception;

/**
 * Class MissingCredentialException
 *
 * @package PayU\Exception
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class MissingCredentialException extends \Exception
{
    /**
     * Default Constructor
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
    }

    /**
     * prints error message
     *
     * @return string
     */
    public function errorMessage()
    {
        $errorMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
            . ': <b>' . $this->getMessage() . '</b>';

        return $errorMsg;
    }
}