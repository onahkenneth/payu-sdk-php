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
 * @property string filter_type
 * @property string filter_id
 * @property string name
 * @property string description
 */
class FmDetails extends PayUModel
{
    /**
     * Type of filter.
     * Valid Values: ["APPROVE", "DENY", "CHALLENGE"]
     *
     * @param string $filter_type
     *
     * @return $this
     */
    public function setFilterType($filter_type)
    {
        $this->filter_type = $filter_type;
        return $this;
    }

    /**
     * Type of filter.
     *
     * @return string
     */
    public function getFilterType()
    {
        return $this->filter_type;
    }

    /**
     * Filter Identifier.
     * Valid Values: ["AVS_NO_MATCH", "AVS_PARTIAL_MATCH", "AVS_UNAVAILABLE_OR_UNSUPPORTED",
     * "CARD_SECURITY_CODE_MISMATCH", "MAXIMUM_TRANSACTION_AMOUNT", "UNCONFIRMED_ADDRESS",
     * "COUNTRY_MONITOR", "LARGE_ORDER_NUMBER", "BILLING_OR_SHIPPING_ADDRESS_MISMATCH",
     * "RISKY_ZIP_CODE", "SUSPECTED_FREIGHT_FORWARDER_CHECK", "TOTAL_PURCHASE_PRICE_MINIMUM",
     * "IP_ADDRESS_VELOCITY", "RISKY_EMAIL_ADDRESS_DOMAIN_CHECK", "RISKY_BANK_IDENTIFICATION_NUMBER_CHECK",
     * "RISKY_IP_ADDRESS_RANGE", "PAYPAL_FRAUD_MODEL"]
     *
     * @param string $filter_id
     *
     * @return $this
     */
    public function setFilterId($filter_id)
    {
        $this->filter_id = $filter_id;
        return $this;
    }

    /**
     * Filter Identifier.
     *
     * @return string
     */
    public function getFilterId()
    {
        return $this->filter_id;
    }

    /**
     * Name of the filter
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Name of the filter
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Description of the filter.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Description of the filter.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
