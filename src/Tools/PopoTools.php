<?php

/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 22:49
 */

namespace WebAppId\DDD\Tools;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class PopoTools
 */
class PopoTools
{
    
    /**
     * @param mixed $object
     * @return string|false
     */
    public function serializeJson($object)
    {
        return json_encode($this->serialize($object));
    }
    
    /**
     * @param $object
     * @return array
     */
    public function serialize($object)
    {
        $objectAsArray = (array)$object;
    
        foreach ($objectAsArray as $key => $value) {
        
            $newKey = $this->fixKey($key, $objectAsArray);
            if ($newKey != $key) {
                $this->replaceKey($objectAsArray, $key, $newKey);
            }
            if ($value instanceof Collection) {
                $value = $this->serialize($objectAsArray[$newKey]);
                $objectAsArray[$newKey] = $value['items'];
            } elseif (is_object($value)) {
                $objectAsArray[$newKey] = $this->serialize($objectAsArray[$newKey]);
            } elseif (is_array($value)) {
                if (isset($value[0])) {
                    for ($i = 0; $i < count($value); $i++) {
                        if ($value[$i] instanceof Model) {
                            //nothing todo
                        } else {
                            $objectAsArrayChild = (array)$value[$i];
                            foreach ($objectAsArrayChild as $childKey => $childValue) {
                                $newChildKey = $this->fixKey($childKey, $objectAsArrayChild);
                                if ($newKey != $key) {
                                    $this->replaceKey($objectAsArrayChild, $childKey, $newChildKey);
                                }
                            }
                            $value[$i] = $objectAsArrayChild;
                        }
                        $objectAsArray[$newKey] = $value;
                    }
                }
            }
        }
        
        return $objectAsArray;
    }
    
    /**
     * @param $array
     * @param $curkey
     * @param $newkey
     * @return bool
     */
    function replaceKey(&$array, $curkey, $newkey)
    {
        if (array_key_exists($curkey, $array)) {
            $array[$newkey] = $array[$curkey];
            unset($array[$curkey]);
            return true;
        }
        
        return false;
    }
    
    /**
     * @param string $oldKey
     * @return string
     */
    function fixKeyName(string $oldKey): string
    {
        return substr($oldKey, strpos($oldKey, "\0", 2) + 1);
    }
}
