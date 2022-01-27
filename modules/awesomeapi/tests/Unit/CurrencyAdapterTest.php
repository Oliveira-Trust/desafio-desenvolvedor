<?php

declare(strict_types=1);

namespace AwesomeApi\Tests\Unit;

use AwesomeApi\Adapters\CurrencyAdapter;
use Tests\TestCase;

class CurrencyAdapterTest extends TestCase
{
    public function test_should_adapt_payload_return_to_object_currency_adapter(): void
    {
        $currencyAdapter = new CurrencyAdapter(self::getPayload());

        $this->assertEquals($currencyAdapter->getName(), self::getPayload()['BRLUSD']['name']);
        $this->assertEquals($currencyAdapter->getBid(), self::getPayload()['BRLUSD']['bid']);
        $this->assertEquals($currencyAdapter->getCode(), self::getPayload()['BRLUSD']['code']);
        $this->assertEquals($currencyAdapter->getCodeIn(), self::getPayload()['BRLUSD']['codein']);
        $this->assertEquals($currencyAdapter->getCreateDate(), self::getPayload()['BRLUSD']['create_date']);
        $this->assertIsFloat($currencyAdapter->getBid());
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