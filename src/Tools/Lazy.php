<?php


namespace WebAppId\DDD\Tools;

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
     */
    public static function copy(object $fromClass, object $toClass, bool $strict = false): object
    {
        foreach (get_object_vars($fromClass) as $key => $value) {
            if ($strict) {
                if (property_exists($toClass, $key)) {
                    $toClass->$key = $value;
                }
            } else {
                $toClass->$key = $value;
            }
        }
        return $toClass;
    }
    
    /**
     * @param array $fromArray
     * @param object $toClass
     * @return object
     */
    public static function copyFromArray(array $fromArray, object $toClass): object
    {
        foreach (get_object_vars($toClass) as $key => $value) {
            $toClass->$key = $fromArray[$key];
        }
        return $toClass;
    }
    
    /**
     * @param string $fromJson
     * @param object $toClass
     * @return object
     */
    public static function copyFromJson(string $fromJson, object $toClass): object
    {
        return self::copyFromArray(json_decode($fromJson,true), $toClass);
    }
}