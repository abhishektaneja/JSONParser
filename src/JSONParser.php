<?php

/**
 * Created by PhpStorm.
 * User: Abhishek
 * Date: 21-12-2014
 * Time: 03:43 PM
 */
class JSONParser
{
    const IS_PUBLIC = 256;
    const PROP_VALID = "isProperty";
    const PROP_ACCESSIBLE = "accessible";
    const PROP_SETTER = "setter";

    private $classObject = array();

    private $propertyAttributes = array(
        self::PROP_VALID => false,
        self::PROP_ACCESSIBLE => false,
        self::PROP_SETTER => null
    );

    private function getPropertyAttributesMap()
    {
        return $this->propertyAttributes;
    }

    public function map($json, $obj)
    {
        $jsonObj = json_decode($json);
        if (null == $jsonObj) {
            throw new JSONParserException("Invalid json");
            return false;
        }
        try {
            return $this->mapJSONToProperties($jsonObj, new ReflectionClass($obj));
        }
        catch(Exception $e){
            throw new JSONParserException("Unable to map json", 0 , $e);
        }
        return null;
    }

    private function  mapJSONToProperties($jsonObj, ReflectionClass $refObj)
    {
        $classFullNameSpace = $refObj -> getNamespaceName()."\\".$refObj -> getName();
        $classObj = new $classFullNameSpace;
        $className = $refObj->getParentClass();
        foreach ($jsonObj as $key => $value) {
            if (!isset($this->classObject[$className][$key])) {
                $this->classObject[$className][$key] = $this->getPropertyAttributes($refObj, $key);
            }
            $propertyAttributes = $this->classObject[$className][$key];
            if($propertyAttributes[self::PROP_VALID] === true){
                if($propertyAttributes[self::PROP_SETTER] != null){
                    $sMethod = $propertyAttributes[self::PROP_SETTER] -> name;
                    if (is_object($value)) {
                        $objClass = $this -> getClassFromNameSpace($refObj -> getNamespaceName(), $key);
                        if($objClass != null) {
                            $value = $this->mapJSONToProperties($value, new ReflectionClass(new $objClass));
                        }
                    }
                    $classObj -> $sMethod($value);
                }else{
                    if($propertyAttributes[self::PROP_ACCESSIBLE] === true) {
                        $classObj->$key = $value;
                    }
                }
            }
        }
        return $classObj;
    }

    private function getClassFromNameSpace($classNameSpace, $subClassName){
        if ($classNameSpace != '\\') {
            return  $classNameSpace . '\\' . ucfirst($subClassName);
        }
        return null;
    }

    private function getPropertyAttributes(ReflectionClass $rcObj, $propName)
    {
        $propertyAttribute = $this->getPropertyAttributesMap();
        $propertyAttribute[self::PROP_VALID] = $rcObj->hasProperty($propName);
        if ($propertyAttribute[self::PROP_VALID]) {
            $rcProp = $rcObj->getProperty($propName);
            if($rcProp->getModifiers() === self::IS_PUBLIC){
                $propertyAttribute[self::PROP_ACCESSIBLE] = true;
            }
            $setterMethodName = "set" . ucfirst($propName);
            if ($rcObj->hasMethod($setterMethodName)) {
                $propertyAttribute[self::PROP_ACCESSIBLE] = true;
                $setterMethod = $rcObj->getMethod($setterMethodName);
                if ($setterMethod->isPublic()) {
                    $setterParams = $setterMethod->getParameters();
                    if (count($setterParams) > 0) {
                        if ($setterParams[0]->getClass() == $rcObj->getParentClass()) {
                            $propertyAttribute[self::PROP_SETTER] = $setterMethod;
                        }
                    }
                }
            }
        }
        return $propertyAttribute;
    }
}

?>