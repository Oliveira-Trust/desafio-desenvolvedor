<?php

declare(strict_types=1);

namespace AwesomeApi\Tests\Unit;

use AwesomeApi\Adapters\CurrencyAdapter;
use AwesomeApi\Models\Currency;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    public function test_should_adapt_currency_adapter_to_currency_object(): void
    {
        $currency = new Currency(new CurrencyAdapter($this->getPayload()));
        $this->assertEquals($currency->getCode(), self::getPayload()['BRLUSD']['code']);
        $this->assertEquals($currency->getCodeIn(), self::getPayload()['BRLUSD']['codein']);
        $this->assertEquals($currency->getBid(), self::getPayload()['BRLUSD']['bid']);
        $this->assertEquals($currency->getName(), self::getPayload()['BRLUSD']['name']);
        $this->assertEquals($currency->getCreateDate(), self::getPayload()['BRLUSD']['create_date']);
    }

    /** @return string[][] */
    private static function getPayload(): array
    {
        return [
            'BRLUSD' => [
                'code' => 'BRL',
                'codein' => 'USD',
                'name' => 'Real Brasileiro/Dólar Americano',
                'high' => '0.185',
                'low' => '0.1827',
                'varBid' => '-0.0013',
                'pctChange' => '-0.71',
                'bid' => '0.1832',
                'ask' => '0.1832',
                'timestamp' => '1642800601',
                'create_date' => '2022-01-21 18:30:01'
            ]
        ];
    }
}