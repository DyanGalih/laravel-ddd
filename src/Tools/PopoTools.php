<?php

/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 22:49
 */

namespace WebAppId\DDD\Tools;

use Illuminate\Database\Eloquent\Collection;

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
        $objectAsArray = (array) $object;
        foreach ($objectAsArray as $key => $value) {
            if (stripos($key, "\0") === 0) {
                $newKey = $this->fixKeyName($key);
                $this->replaceKey($objectAsArray, $key, $newKey);
            }else{
                $newKey = $key;
            }
    
            if($value instanceof Collection){
                $value = $this->serialize($objectAsArray[$newKey]);
                $objectAsArray[$newKey] = $value['items'];
            }elseif(is_object($value)) {
                $objectAsArray[$newKey] = $this->serialize($objectAsArray[$newKey]);
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
    function fixKeyName(string $oldKey) : string
    {
        return substr($oldKey, strpos($oldKey, "\0", 2) + 1);
    }
}
