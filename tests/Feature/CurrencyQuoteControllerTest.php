<?php

namespace Tests\Feature;

use App\Enums\CurrencyOrigin;
use App\Enums\CurrencyTarget;
use App\Enums\PaymentMethod;
use App\Models\User;
use App\Services\CurrencyQuoteClientService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use Tests\TestCase;

class CurrencyQuoteControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();

        $this->be($user);
    }

    /**
     * @test
     */
    public function itShouldReturnFormToConvert()
    {
        $this->get(route('currencyQuote.index'))->assertViewHasAll([
            'options' => [
                'currencyOrigin' => CurrencyOrigin::cases(),
                'paymentMethod' => PaymentMethod::cases(),
                'currencyTarget' => CurrencyTarget::cases()
            ]
        ]);
    }
    /**
     * @test
     */
    public function itShouldConvertCurrency()
    {
        $currencyQuoteClientService = Mockery::mock(CurrencyQuoteClientService::class);
        app()->instance(CurrencyQuoteClientService::class, $currencyQuoteClientService);

        $currencyQuoteClientService->shouldReceive('getLastQuote')
            ->once()
            ->andReturn(0.1962);

        $this->postJson(route('currencyQuote.toConvert'), [
            "currency_origin" => "BRL",
            "target_currency" => "USD",
            "value" => "5000",
            "payment_method" => "bankSlip"
        ])->assertViewHasAll([
            'quota' => [
                'currencyOrigin' => 'BRL',
                'targetCurrency' => 'USD',
                'valueOrigin' => 'BRL 5000,00',
                'valueOriginWithDiscount' => 'BRL 4877,50',
                'ratePayment' => 'BRL 72,50',
                'rateConvert' => 'BRL 50,00',
                'valueTargetCurrency' => 'USD 956,97',
                'valueBaseConvert' => 'BRL 5,10',
                'paymentMethod' => 'Bank slip',
            ]
        ]);
    }

    /**
     * @test
     * @dataProvider dataProviderError
     */
    public function itShouldReturnError(array $payload, array $error)
    {
        $this->postJson(route('currencyQuote.toConvert'), $payload)
            ->assertJsonValidationErrors($error);
    }

    public function dataProviderError(): array
    {
        return [
            [
                [
                    "target_currency" => "USD",
                    "value" => "5000",
                    "payment_method" => "bankSlip"
                ],
                ['currency_origin' => 'The currency origin field is required.']
            ],
            [
                [
                    "currency_origin" => "BRL",
                    "value" => "5000",
                    "payment_method" => "bankSlip"
                ],
                ['target_currency' => 'The target currency field is required.']
            ],
            [
                [
                    "currency_origin" => "BRL",
                    "target_currency" => "USD",
                    "payment_method" => "bankSlip"
                ],
                ['value' => 'The value field is required.']
            ],
            [
                [
                    "currency_origin" => "BRL",
                    "target_currency" => "USD",
                    "value" => "5000",
                ],
                ['payment_method' => 'The payment method field is required.']
            ],
            [
                [
                    "currency_origin" => "BRL",
                    "target_currency" => "USD",
                    "value" => "999,99",
                    "payment_method" => "bankSlip"
                ],
                ['value' => 'Minimum BRL 1000,00 Maximum BRL 100000,00']
            ],
            [
                [
                    "currency_origin" => "BRL",
                    "target_currency" => "USD",
                    "value" => "100000,01",
                    "payment_method" => "bankSlip"
                ],
                ['value' => 'Minimum BRL 1000,00 Maximum BRL 100000,00']
            ],
            [
                [
                    "currency_origin" => "BRL",
                    "target_currency" => "USD",
                    "value" => "5000",
                    'payment_method' => 'money'
                ],
                ['payment_method' => 'The selected payment method is invalid.']
            ],
            [
                [
                    "currency_origin" => "BR",
                    "target_currency" => "USD",
                    "value" => "5000",
                    'payment_method' => 'bankSlip'
                ],
                ['currency_origin' => 'The selected currency origin is invalid.']
            ],
            [
                [
                    "currency_origin" => "BRL",
                    "target_currency" => "BRL",
                    "value" => "5000",
                    'payment_method' => 'bankSlip'
                ],
                ['target_currency' => 'The selected target currency is invalid.']
            ],
        ];
    }
}
