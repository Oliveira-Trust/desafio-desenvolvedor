<?php

namespace Tests\Unit;

use ExchangeRate\ClientExchange;
use ExchangeRate\Models\Currency;
use ExchangeRate\Models\ExchangeRate;
use ExchangeRate\Providers\ExchangeRateResourceProvider;
use Tests\TestCase;

class ClientExchangeTest extends TestCase
{

    public function testGetCurrenciesList()
    {

        $currencies = ClientExchange::getCurrenciesList();
        $this->assertIsArray($currencies);
        $first = new \stdClass();
        if ($this->count($currencies)) {
            $first = array_pop($currencies);
            $this->assertInstanceOf(Currency::class, $first);
        }
        $this->assertInstanceOf(Currency::class, $first);
    }

    public function testExchangeRate()
    {
        $exchangeRate = ClientExchange::getExchangeRate('BRL', 'USD');
        $this->assertInstanceOf(ExchangeRate::class, $exchangeRate);
    }

    public function testIsValidCurrency()
    {
        $isValid = ClientExchange::isValidCurrency('BRL');
        $this->assertTrue($isValid);
    }

    public function testIsNoValidCurrency()
    {
        $isValid = ClientExchange::isValidCurrency('BRLTR');
        $this->assertFalse($isValid);
    }
}
