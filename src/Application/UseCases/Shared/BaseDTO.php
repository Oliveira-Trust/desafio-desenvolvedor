<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Application\UseCases\Shared;

abstract class BaseDTO
{
    public function toArray()
    {
        $reflex = new \ReflectionClass($this);
        $props = $reflex->getProperties(\ReflectionProperty::IS_PUBLIC);

        $propsValues = [];

        foreach ($props as $prop) {
            $propsValues[$prop->getName()] = $prop->getValue($this);
        }

        return $propsValues;
    }
}
