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
 * Class FmDetails
 *
 * Details of Fraud Management (FM).
 *
 * @package PayU\Api
 *
 * @property string checkFraudOverride
 * @property string merchantWebsite
 * @property string pcFingerPrint
 * @property string resultCode
 * @property string resultMessage
 */
class FmDetails extends PayUModel
{
    /**
     * Type of filter.
     * Valid Values: ["APPROVE", "DENY", "CHALLENGE"]
     *
     * @param string $filterType
     *
     * @return $this
     */
    public function setFilterType($filterType)
    {
        $this->filterType = $filterType;
        return $this;
    }

    /**
     * Type of filter.
     *
     * @return string
     */
    public function getFilterType()
    {
        return $this->filterType;
    }

    /**
     * Check Fraud Override filter.
     *
     * @param string $checkFraudOverride
     *
     * @return $this
     */
    public function setCheckFraudOverride($checkFraudOverride)
    {
        $this->checkFraudOverride = $checkFraudOverride;
        return $this;
    }

    /**
     * Check Fraud Override filter.
     *
     * @return string
     */
    public function getCheckFraudOverride()
    {
        return $this->checkFraudOverride;
    }

    /**
     * Merchant website
     *
     * @param string $merchantWebsite
     *
     * @return $this
     */
    public function setMerchantWebsite($merchantWebsite)
    {
        $this->merchantWebsite = $merchantWebsite;
        return $this;
    }

    /**
     * Merchant website
     *
     * @return string
     */
    public function getMerchantWebsite()
    {
        return $this->merchantWebsite;
    }

    /**
     * Finger print of client machine.
     *
     * @param string $pcFingerPrint
     *
     * @return $this
     */
    public function setPCFingerPrint($pcFingerPrint)
    {
        $this->pcFingerPrint = $pcFingerPrint;
        return $this;
    }

    /**
     * Finger print of client machine.
     *
     * @return string
     */
    public function getPCFingerPrint()
    {
        return $this->pcFingerPrint;
    }

    /**
     * Fraud management processing result code.
     *
     * @param string $resultCode
     *
     * @return $this
     */
    public function setResultCode($resultCode)
    {
        $this->resultCode = $resultCode;
        return $this;
    }

    /**
     * Fraud management processing result code.
     *
     * @return string
     */
    public function getResultCode()
    {
        return $this->resultCode;
    }

    /**
     * Fraud management processing result message.
     *
     * @param string $resultMessage
     *
     * @return $this
     */
    public function setResultMessage($resultMessage)
    {
        $this->resultMessage = $resultMessage;
        return $this;
    }

    /**
     * Fraud management processing result message.
     *
     * @return string
     */
    public function getResultMessage()
    {
        return $this->resultMessage;
    }
}
