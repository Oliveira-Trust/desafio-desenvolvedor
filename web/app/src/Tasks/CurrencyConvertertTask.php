<?php

namespace App\Tasks;

use Exception;
use App\Services\CurrencyConvertService;

class CurrencyConvertertTask
{
    public function run(string $code, float $value): array
    {
        try {
            return (new CurrencyConvertService())
                ->using($code)
                ->withValue($value)
                ->apply();
        } catch (Exception $e) {
            log_error($e);
            return [];
        }
    }
}
