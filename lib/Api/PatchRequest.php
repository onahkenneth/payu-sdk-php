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
 * Class PatchRequest
 *
 * A JSON patch request.
 *
 * @package PayU\Api
 *
 * @property \PayU\Api\Patch[] patches
 */
class PatchRequest extends PayUModel
{
    /**
     * Append Patches to the list.
     *
     * @param \PayU\Api\Patch $patch
     *
     * @return $this
     */
    public function addPatch($patch)
    {
        if (!$this->getPatches()) {
            return $this->setPatches(array($patch));
        } else {
            return $this->setPatches(
                array_merge($this->getPatches(), array($patch))
            );
        }
    }

    /**
     * Placeholder for holding array of patch objects
     *
     * @return \PayU\Api\Patch[]
     */
    public function getPatches()
    {
        return $this->patches;
    }

    /**
     * Placeholder for holding array of patch objects
     *
     * @param \PayU\Api\Patch[] $patches
     *
     * @return $this
     */
    public function setPatches($patches)
    {
        $this->patches = $patches;
        return $this;
    }

    /**
     * Remove Patches from the list.
     *
     * @param \PayU\Api\Patch $patch
     *
     * @return $this
     */
    public function removePatch($patch)
    {
        return $this->setPatches(
            array_diff($this->getPatches(), array($patch))
        );
    }

    /**
     * As PatchRequest holds the array of Patch object, we would override the json conversion to return
     * a json representation of array of Patch objects.
     *
     * @param int $options
     *
     * @return mixed|string
     */
    public function toJSON($options = 0)
    {
        $json = array();
        foreach ($this->getPatches() as $patch) {
            $json[] = $patch->toArray();
        }
        return str_replace('\\/', '/', json_encode($json, $options));
    }
}