<?php

namespace App\Services;

use NilPortugues\Serializer\JsonSerializer;

class Service
{
    private function serializer(): JsonSerializer
    {
        return new JsonSerializer();
    }

    protected function deserialize($data)
    {
        return $this->serializer()->unserialize($data);
    }
}
