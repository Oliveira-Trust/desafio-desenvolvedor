<?php

namespace Tests\Unit;

use DeepCopy\Reflection\ReflectionHelper;
use Mockery;
use Modules\Exchange\Entities\Rates;
use Modules\Exchange\Services\ExchangeConversionService;
use ReflectionClass;
use Tests\TestCase;

class ExchangeConversionsTest extends TestCase
{
    /**
     * @group exchanges
     * @group exchange
     */
    public function test_exchange_conversions()
    {
        $destinationCurrency = 'USD';
        $conversionValue = 5000;
        $paymentMethod = 'bank_slips';
        $exchange = 5.30;
        $rates = Rates::factory()->make([
            'bank_slips' => 1.45,
            'credit_card' => 7.63,
            'purchase_price_above' => 1,
            'purchase_price_below' => 2,
            'purchase_price' => 3000,
            'base_currency' => 'BRL'
        ]);

        $exchangeConversion = new ExchangeConversionService($destinationCurrency, $conversionValue, $paymentMethod, $exchange, $rates);

        $mock = Mockery::mock(ExchangeConversionService::class)->shouldAllowMockingProtectedMethods();
        $mock->shouldReceive('getCurrentExchangeRate')->andReturn(null);

        $exchangeConversion->execute();

        $result = $exchangeConversion->toArray();

        $this->assertEquals($rates->base_currency, $result['origin_currency'], 'Moeda de origem');
        $this->assertEquals($destinationCurrency, $result['destination_currency'], 'Moeda de destino');
        $this->assertEquals($conversionValue, $result['conversion_value'], 'Valor para conversão');
        $this->assertEquals($paymentMethod, $result['payment_method'], 'Método de pagamento');
        $this->assertEquals($exchange, $result['exchange'], 'Câmbio atual');
        $this->assertEquals(72.5, $result['pay_rate_value'], 'Valor da taxa de pagamento descontado do valor para conversão');
        $this->assertEquals(50.0, $result['exchange_rate_value'], 'Valor da taxa de câmbio descontado do valor para conversão');
        $this->assertEquals($rates->bank_slips, $result['pay_rate'], 'Taxa de pagamento atual');
        $this->assertEquals($rates->purchase_price_above, $result['exchange_rate'], 'Taxa de câmbio descontado atual');
        $this->assertEquals(4877.5, $result['conversion_value_with_fees'], 'Valor para conversão descontado as taxas');
        $this->assertEquals(920.28, $result['purchased_value'], 'Valor comprado');
    }
}
