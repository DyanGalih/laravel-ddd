<?php


namespace WebAppId\DDD\Tools;

use Exception;
use ReflectionException;
use ReflectionProperty;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 2019-07-02
 * Time: 07:11
 * Class Lazy
 * @package WebAppId\DDD\Tools
 */
class Lazy
{
    /**
     * @param object $fromClass
     * @param object $toClass
     * @param bool $strict
     * @return object
     * @throws ReflectionException
     */
    public static function copy(object $fromClass, object $toClass, bool $strict = false): object
    {
        if (!$strict) {
            foreach (get_object_vars($fromClass) as $key => $value) {
                $toClass->$key = $value;
            }
        } else {
            foreach (get_object_vars($toClass) as $key => $value) {
                if (property_exists($toClass, $key)) {
                    if (self::_validate($fromClass, $toClass, $key)) {
                        $toClass->$key = $fromClass->$key;
                    }
                }
            }
        }
        return $toClass;
    }
    
    /**
     * @param $fromClass
     * @param $toClass
     * @param $key
     * @return bool
     * @throws ReflectionException
     * @throws Exception
     */
    private static function _validate($fromClass, $toClass, $key)
    {
        $property = new ReflectionProperty($toClass, $key);
        $propertyClass = self::getVar($property);
        
        if (gettype($fromClass->$key) == $propertyClass) {
            return true;
        } else {
            throw new Exception('Type Mismatch on property ' . $key . '. The property type is ' . $propertyClass . ' but the value type is ' . gettype($fromClass->$key));
        }
    }
    
    /**
     * @param object $class
     * @return bool
     * @throws ReflectionException
     */
    public static function validate(object $class)
    {
        $status = true;
        foreach (get_object_vars($class) as $key => $value) {
            if ($status) {
                $status = self::_validate($class, $class, $key);
            }
        }
        
        return $status;
    }
    
    /**
     * @param array $fromArray
     * @param object $toClass
     * @return object
     * @throws ReflectionException
     */
    public static function copyFromArray(array $fromArray, object $toClass): object
    {
        
        foreach (get_object_vars($toClass) as $key => $value) {
            self::_validate((object)$fromArray, $toClass, $key);
            $toClass->$key = $fromArray[$key];
        }
        return $toClass;
    }
    
    /**
     * @param string $fromJson
     * @param object $toClass
     * @return object
     * @throws ReflectionException
     */
    public static function copyFromJson(string $fromJson, object $toClass): object
    {
        return self::copyFromArray(json_decode($fromJson, true), $toClass);
    }
    
    /**
     * @param ReflectionProperty $property
     * @return mixed|null
     */
    private static function getVar(ReflectionProperty $property)
    {
        $typeMapping = [];
        $typeMapping['int'] = 'integer';
        $typeMapping['bool'] = 'boolean';
        
        // Get the content of the @var annotation
        if (preg_match('/@var\s+([^\s]+)/', $property->getDocComment(), $matches)) {
            if (isset($typeMapping[$matches[1]])) {
                return $typeMapping[$matches[1]];
            } else {
                return $matches[1];
            }
        } else {
            return null;
        }
    }
}
