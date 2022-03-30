<?php

namespace Tests\Unit;

use App\Models\CurrencyPurchase;
use App\Models\User;
use App\Services\CurrencyService;
use Tests\TestCase;


class CurrencyTest extends TestCase
{
    private function makeFakerCurrencyPurchase($attributes = [])
    {
        return CurrencyPurchase::factory()->makeOne($attributes);
    }

    public function testGetPurchases()
    {
        $currencies = app(CurrencyService::class)->getPurchases()->toArray();
        $this->assertIsArray($currencies);
    }

    public function testBuyCurrency()
    {
        $user = User::factory()->create();
        auth()->login($user);
        $currencyPurchase = $this->makeFakerCurrencyPurchase()->toArray();
        $currencyService = app(CurrencyService::class);
        $currencyService->buyCurrency($currencyPurchase);
        $savedCurrency = $currencyService->getPurchases($currencyPurchase);
        $this->assertNotEmpty($savedCurrency);
    }

}
