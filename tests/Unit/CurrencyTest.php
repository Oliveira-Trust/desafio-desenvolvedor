<?php

namespace Tests\Unit;

use App\Services\CurrencyService;
use Tests\TestCase;


class CurrencyTest extends TestCase
{

    public function getCurrencies()
    {
        $currencies = app(CurrencyService::class)->getCurrencies()->toArray();
        $this->assertIsArray($currencies);
    }
}
