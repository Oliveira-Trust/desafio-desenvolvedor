<?php

namespace App\Repository;

use ReflectionClass, ReflectionProperty;

abstract class AbstractDataTransferObject
{

    public function __construct(array $parameters = [])
    {
        $class = new ReflectionClass(static::class);

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty){
            $property = $reflectionProperty->getName();
            if (isset($parameters[$property]) && $parameters[$property]) {
                $this->{$property} = $parameters[$property];
            }
        }
    }

    public function toArray() {
        $class = new ReflectionClass(static::class);

        $return = [];
        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty){
            $property = $reflectionProperty->getName();
            if ($this->{$property}) {
                $return[$property] = $this->{$property};
            }
        }
        return $return;
    }

}