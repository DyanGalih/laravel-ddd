<?php

/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 22:49
 */

namespace WebAppId\DDD\Tools;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CollectionSupport;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class PopoTools
 */
class PopoTools
{
    /**
     * Local cache of a property getters per class - optimize reflection code if the same object appears several times
     * @var array
     */
    private $classPropertyGetters = array();
    
    /**
     * @param mixed $object
     * @return string|false
     * @throws \ReflectionException
     */
    public function serializeJson($object)
    {
        return json_encode($this->serializeInternal($object));
    }
    
    /**
     * @param $object
     * @return array
     * @throws \ReflectionException
     */
    public function serialize($object)
    {
        return $this->serializeInternal($object);
    }
    
    /**
     * @param $object
     * @return array
     * @throws \ReflectionException
     */
    private function serializeInternal($object)
    {
        if ($object instanceof Collection || $object instanceof CollectionSupport) {
            $result = $object;
        } elseif (is_array($object)) {
            $result = $this->serializeArray($object);
        } elseif (is_object($object)) {
            $result = $this->serializeObject($object);
        } else {
            $result = $object;
        }
        return $result;
    }
    
    /**
     * @param $object
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    private function getClassPropertyGetters($object)
    {
        $className = get_class($object);
        if (!isset($this->classPropertyGetters[$className])) {
            $reflector = new \ReflectionClass($className);
            $properties = $reflector->getProperties();
            $getters = array();
            foreach ($properties as $property) {
                $name = $property->getName();
                $getter = "get" . str_replace("_", "", ucfirst($name));
                try {
                    $reflector->getMethod($getter);
                    $getters[$name] = $getter;
                } catch (\Exception $e) {
                    report($e);
                    // if no getter for a specific property - ignore it
                }
            }
            
            $this->classPropertyGetters[$className] = $getters;
        }
        return $this->classPropertyGetters[$className];
    }
    
    /**
     * @param $object
     * @return array
     * @throws \ReflectionException
     */
    private function serializeObject($object)
    {
        $properties = $this->getClassPropertyGetters($object);
        $data = array();
        foreach ($properties as $name => $property) {
            $data[$name] = $this->serializeInternal($object->$property());
        }
        return $data;
    }
    
    /**
     * @param $array
     * @return array
     * @throws \ReflectionException
     */
    private function serializeArray($array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            $result[$key] = $this->serializeInternal($value);
        }
        return $result;
    }
}