<?php

namespace App\Services\AwesomeAPI\Types;

readonly class Currency
{
    public function __construct(
        public string $code,
        public string $name
    ) { }
}
