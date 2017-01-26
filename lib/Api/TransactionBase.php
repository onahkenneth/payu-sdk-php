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

/**
 * Class TransactionBase
 *
 * A transaction defines the contract of a payment - what is the payment for and
 * who is fulfilling it.
 *
 * @package PayU\Api
 *
 * @property \PayU\Api\RelatedResources[] related_resources
 */
class TransactionBase extends CartBase
{
    /**
     * List of financial transactions (Payment, Reserve, Credit) related to the payment.
     *
     *
     * @param \PayU\Api\RelatedResources[] $related_resources
     *
     * @return $this
     */
    public function setRelatedResources($related_resources)
    {
        $this->related_resources = $related_resources;
        return $this;
    }

    /**
     * List of financial transactions (Payment, Reserve, Credit) related to the payment.
     *
     * @return \PayU\Api\RelatedResources[]
     */
    public function getRelatedResources()
    {
        return $this->related_resources;
    }
}
