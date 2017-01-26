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
use PayU\Validation\UrlValidator;

/**
 * Class RedirectUrls
 *
 * Set of redirect URLs.
 *
 * @package PayU\Api
 *
 * @property string return_url
 * @property string cancel_url
 * @property string notify_url
 */
class RedirectUrls extends PayUModel
{
    /**
     * Url where the payer would be redirected to after approving the payment
     * Required for Redirect Payment Page
     *
     * @param string $return_url
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setReturnUrl($return_url)
    {
        UrlValidator::validate($return_url, "ReturnUrl");
        $this->return_url = $return_url;
        return $this;
    }

    /**
     * Url where the payer would be redirected to after approving the payment
     * Required for Redirect Payment Page
     *
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->return_url;
    }

    /**
     * Url where the payer would be redirected to after canceling the payment.
     * Required for Redirect Payment Page
     *
     * @param string $cancel_url
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setCancelUrl($cancel_url)
    {
        UrlValidator::validate($cancel_url, "CancelUrl");
        $this->cancel_url = $cancel_url;
        return $this;
    }

    /**
     * Url where the payer would be redirected to after canceling the payment
     * Required for Redirect Payment Page
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->cancel_url;
    }

    /**
     * Url where the Instant Payment Notification requests are sent.
     *
     * @param string $notify_url
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setNotifyUrl($notify_url)
    {
        UrlValidator::validate($notify_url, "NotifyUrl");
        $this->notify_url = $notify_url;
        return $this;
    }

    /**
     * Url where the Instant Payment Notification requests are sent.
     *
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }
}
