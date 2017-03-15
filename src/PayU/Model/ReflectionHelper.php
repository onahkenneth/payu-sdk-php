<?php

namespace PayU\Model;

use PayU\Exception\ConfigurationException;

/**
 * Class ReflectionHelper
 *
 * Gets Property Class of the given property.
 * If the class is null, it returns null.
 * If the property is not found, it returns null.
 *
 * @package PayU\Model
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class ReflectionHelper
{
    /**
     * Reflection Methods
     *
     * @var \ReflectionMethod[]
     */
    private static $propertiesRefl = array();

    /**
     * Properties Type
     *
     * @var string[]
     */
    private static $propertiesType = array();


    /**
     * Gets Property Class of the given property.
     * If the class is null, it returns null.
     * If the property is not found, it returns null.
     *
     * @param $class
     * @param $propertyName
     * @return null|string
     * @throws ConfigurationException
     */
    public static function getPropertyClass($class, $propertyName)
    {
        if ($class == get_class(new PayUModel())) {
            // Make it generic if PayUModel is used for generating this
            return get_class(new PayUModel());
        }

        // If the class doesn't exist, or the method doesn't exist, return null.
        if (!class_exists($class) || !method_exists($class, self::getter($class, $propertyName))) {
            return null;
        }

        if (($annotations = self::propertyAnnotations($class, $propertyName)) && isset($annotations['return'])) {
            $param = $annotations['return'];
        }

        if (isset($param)) {
            $anno = preg_split("/[\s\[\]]+/", $param);
            return $anno[0];
        } else {
            throw new ConfigurationException("Getter function for '$propertyName' in '$class' class should have a proper return type.");
        }
    }

    /**
     * Returns the properly formatted getter function name based on class name and property
     * Formats the property name to a standard getter function
     *
     * @param string $class
     * @param string $propertyName
     * @return string getter function name
     */
    public static function getter($class, $propertyName)
    {
        return method_exists($class, "get" . ucfirst($propertyName)) ?
            "get" . ucfirst($propertyName) :
            "get" . preg_replace_callback("/([_\-\s]?([a-z0-9]+))/", "self::replace_callback", $propertyName);
    }

    /**
     * Retrieves Annotations of each property
     *
     * @param $class
     * @param $propertyName
     * @throws \RuntimeException
     * @return mixed
     */
    public static function propertyAnnotations($class, $propertyName)
    {
        $class = is_object($class) ? get_class($class) : $class;
        if (!class_exists('ReflectionProperty')) {
            throw new \RuntimeException("Property type of " . $class . "::{$propertyName} cannot be resolved");
        }

        if ($annotations =& self::$propertiesType[$class][$propertyName]) {
            return $annotations;
        }

        if (!($refl =& self::$propertiesRefl[$class][$propertyName])) {
            $getter = self::getter($class, $propertyName);
            $refl = new \ReflectionMethod($class, $getter);
            self::$propertiesRefl[$class][$propertyName] = $refl;
        }

        if (!preg_match_all(
            '~\@([^\s@\(]+)[\t ]*(?:\(?([^\n@]+)\)?)?~i',
            $refl->getDocComment(),
            $annots,
            PREG_PATTERN_ORDER
        )
        ) {
            return null;
        }
        foreach ($annots[1] as $i => $annot) {
            $annotations[strtolower($annot)] = empty($annots[2][$i]) ? true : rtrim($annots[2][$i], " \t\n\r)");
        }

        return $annotations;
    }

    public static function getClassAnnotations($class)
    {
        $class = is_object($class) ? get_class($class) : $class;
        $r = new \ReflectionClass($class);
        $doc = $r->getDocComment();
        preg_match_all('#@property(.*?)\n#s', $doc, $annotations);
        return $annotations[1];
    }

    /**
     * Checks if the Property is of type array or an object
     *
     * @param $class
     * @param $propertyName
     * @return null|boolean
     * @throws ConfigurationException
     */
    public static function isPropertyClassArray($class, $propertyName)
    {
        // If the class doesn't exist, or the method doesn't exist, return null.
        if (!class_exists($class) || !method_exists($class, self::getter($class, $propertyName))) {
            return null;
        }

        if (($annotations = self::propertyAnnotations($class, $propertyName)) && isset($annotations['return'])) {
            $param = $annotations['return'];
        }

        if (isset($param)) {
            return substr($param, -strlen('[]')) === '[]';
        } else {
            throw new ConfigurationException("Getter function for '$propertyName' in '$class' class should have a proper return type.");
        }
    }

    /**
     * preg_replace_callback callback function
     *
     * @param $match
     * @return string
     */
    private static function replace_callback($match)
    {
        return ucwords($match[2]);
    }
}
