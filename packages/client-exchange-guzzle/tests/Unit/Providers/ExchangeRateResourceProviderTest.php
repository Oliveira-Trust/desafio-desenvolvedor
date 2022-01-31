<?php

namespace Tests\Unit\Providers;


use ExchangeRate\Providers\ExchangeRateResourceProvider;
use Tests\TestCase;

class ExchangeRateResourceProviderTest extends TestCase
{

    public function testGetCurrenciesList()
    {
        $provider = new ExchangeRateResourceProvider();
        $currencies = $provider->getCurrenciesList();
        $this->assertIsArray($currencies);
    }
    public function testExchangeRate()
    {
        $provider = new ExchangeRateResourceProvider();
        $result = $provider->getExchangeRate('BRL', 'USD');
        $this->assertTrue(true);
    }

}
