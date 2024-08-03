<?php

namespace Tests\Unit;

use App\Services\CurrencyConverterService;
use Mockery;
use PHPUnit\Framework\TestCase;

class CurrencyConverterServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testConvertService()
    {
        $mock = Mockery::mock(CurrencyConverterService::class)->makePartial();

        // Definindo as expectativas para os métodos chamados dentro de convertService
        $mock->shouldReceive('convertionRate')
            ->once()
            ->with(1000)
            ->andReturn(20);

        $mock->shouldReceive('paymentConditionsRates')
            ->once()
            ->with(1000, 'credit_card')
            ->andReturn(76.3);

        $mock->shouldReceive('getConversionRate')
            ->once()
            ->with('BRL', 'USD')
            ->andReturn(0.2);

        $mock->shouldReceive('getCurrencyValue')
            ->once()
            ->with('USD', 'BRL')
            ->andReturn(5);

        $result = $mock->convertService('BRL', 'USD', 1000, 'credit_card');

        // Assert the results
        $this->assertEquals($result, [
            'from' => 'BRL',
            'to' => 'USD',
            'amount' => 1096.3,
            'payment_method' => 'credit_card',
            'currency_value' => 5,
            'purchase_amount' => 219.26,
            'conversion_rate' => 20,
            'payment_rate' => 76.3,
            'purchase_price_excluding_taxes' => 1000
        ]);
    }
}
