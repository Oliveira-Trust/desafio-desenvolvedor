<?php

namespace Tests\Controllers\Feature;

use App\Enums\CurrencyOrigin;
use App\Enums\CurrencyTarget;
use App\Enums\PaymentMethod;
use App\Mail\QuotaMail;
use App\Models\QuotationHistory;
use App\Models\User;
use App\Services\CurrencyQuoteClientService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        $currencyQuoteClientService->shouldReceive('getLastAks')
            ->once()
            ->andReturn(0.1962);

        $response = $this->postJson(route('currencyQuote.toConvert'), [
            "currency_origin" => "BRL",
            "target_currency" => "USD",
            "value" => "5000",
            "payment_method" => "bankSlip"
        ]);

        $quotationHistory = (Auth::user())->load('quotationHistory')->quotationHistory;

        $response->assertViewHasAll([
            'quotationHistory' => $quotationHistory
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

    /**
     * @test
     */
    public function itShouldSendMail()
    {
        $quotationHistory = QuotationHistory::factory()->create([
            "currency_origin" => "BRL",
            "target_currency" => "USD",
            "value_origin" => "5000.00",
            "value_origin_with_discount" => "4877.50",
            "rate_payment" => "72.50",
            "rate_convert" => "50.00",
            "value_target_currency" => "944.77",
            "value_base_convert" => "5.16",
            "payment_method" => "bankSlip",
            'user_id' => User::factory()->create()->id
        ]);

        Mail::fake();

        $this->get(route('currencyQuote.sendToEmail', ['quotationHistory' => $quotationHistory->id]));

        Mail::assertSent(QuotaMail::class);
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
