<?php

namespace App\Services\ApiConsume\AwesomeApi\DTO;

use Spatie\LaravelData\Data;

class CurrencyData extends Data {

    public function __construct(
        public string $code,
        public string $codein,
        public string $name,
        public string $high,
    ) {

    }
}
