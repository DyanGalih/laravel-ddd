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
}