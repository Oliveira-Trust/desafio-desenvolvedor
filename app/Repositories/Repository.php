<?php

namespace App\Repositories;

abstract class Repository
{
    public function __call($name, $arguments)
    {
        return $this->model->{$name}(...$arguments);
    }
}