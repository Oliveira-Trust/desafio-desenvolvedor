<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\ConversionRate;
use App\Models\CreditCard;
use App\Models\Money;
use App\Models\Quotation;
use AwesomeApi\Adapters\CurrencyAdapter;
use AwesomeApi\Models\Currency;
use Tests\TestCase;

class QuotationTest extends TestCase
{
    public function test_should_return_an_array_with_values(): void
    {
        $money = new Money(['money' => 5000]);
        $creditCard = new CreditCard($money);
        $conversionRate = new ConversionRate($money);
        $currency = new Currency(new CurrencyAdapter($this->payload()));
        $quote = new Quotation($creditCard, $money, $conversionRate, $currency);

        $this->assertInstanceOf(Quotation::class, $quote->generate());
        $this->assertIsArray($quote->toArray());
    }

    /** @return string[][] */
    private function payload(): array
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