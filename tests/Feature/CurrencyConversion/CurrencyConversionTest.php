<?php

namespace Tests\Feature\CurrencyConversion;

use App\Enum\CurrencyEnum;
use App\Enum\PaymentMethodEnum;
use App\Repositories\Api\CurrencyConversionRepository;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\Traits\EconomiaAwesomeApiMock;

class CurrencyConversionTest extends TestCase
{
    use EconomiaAwesomeApiMock;

    const ROUTE = 'currency-conversion';

    #[Test]
    public function expects_true_when_route_exists(): void
    {
        $this->assertTrue(Route::has(self::ROUTE));
    }

    #[Test]
    public function expects_failure_when_converting_unsuported_currency(): void
    {
        $payload = [
            'target' => 'XXY',
        ];

        $response = $this->postJson(route(self::ROUTE), $payload);

        $response->assertUnprocessable()->assertJsonValidationErrorFor('target');
    }

    #[Test]
    public function expects_failure_when_converting_unsuported_values(): void
    {
        $payload = [
            'conversion_value' => 100_000_000 * 100,
        ];

        $response = $this->postJson(route(self::ROUTE), $payload);

        $response->assertUnprocessable()->assertJsonValidationErrorFor('conversion_value');
    }

    #[Test]
    public function expects_failure_when_converting_unsuported_payment_method(): void
    {
        $payload = [
            'payment_method' => fake()->word(),
        ];

        $response = $this->postJson(route(self::ROUTE), $payload);

        $response->assertUnprocessable()->assertJsonValidationErrorFor('payment_method');
    }

    #[Test]
    public function expects_failure_when_external_service_fails_unknow_reason(): void
    {
        $payload = [
            'target' => fake()->randomElement(CurrencyEnum::convertable()),
            'conversion_value' => 100_000 * 100,
            'payment_method' => PaymentMethodEnum::CREDIT_CARD->value,
        ];

        $content = $this->mockCurrencyException('BRL', $payload['target']);
        $this->instance(
            CurrencyConversionRepository::class,
            $this->mockCurrencyConversionContractRepositoryException($content, Response::HTTP_INTERNAL_SERVER_ERROR)
        );

        $response = $this->postJson(route(self::ROUTE), $payload);

        $response->assertInternalServerError()
            ->assertJson([
                'message' => __('messages.currency-conversion.failed'),
            ]);
    }

    #[Test]
    public function expects_failure_when_external_service_conversion_fails(): void
    {
        $payload = [
            'target' => fake()->randomElement(CurrencyEnum::convertable()),
            'conversion_value' => 100_000 * 100,
            'payment_method' => PaymentMethodEnum::CREDIT_CARD->value,
        ];

        $content = $this->mockCurrencyNotFoundException('BRL', $payload['target']);
        $this->instance(
            CurrencyConversionRepository::class,
            $this->mockCurrencyConversionContractRepositoryException($content, Response::HTTP_UNPROCESSABLE_ENTITY)
        );

        $response = $this->postJson(route(self::ROUTE), $payload);

        $response->assertUnprocessable()
            ->assertJson([
                'message' => __('messages.currency-conversion.coin-not-supported')
            ]);
    }

    #[Test]
    public function expects_success_when_credit_card_payload_is_valid(): void
    {
        $payload = [
            'target' => fake()->randomElement(CurrencyEnum::convertable()),
            'conversion_value' => 100_000 * 100,
            'payment_method' => PaymentMethodEnum::CREDIT_CARD->value,
        ];

        $content = $this->mockCurrencyConversionData('BRL', $payload['target']);
        $this->instance(CurrencyConversionRepository::class, $this->mockCurrencyConversionContractRepository($content));

        $response = $this->postJson(route(self::ROUTE), $payload);

        $response->assertOk()->assertJson([
            'data' => [
                'origin' => 'BRL',
                'target' => $payload['target'],
                'payment_method' => $payload['payment_method'],
                'payment_method_tax' => 763000,
                'conversion_value' => $payload['conversion_value'],
                'conversion_tax' => 100000,
            ]
        ]);
    }

    #[Test]
    public function expects_success_when_payload_is_valid(): void
    {
        $payload = [
            'target' => fake()->randomElement(CurrencyEnum::convertable()),
            'conversion_value' => 100_000 * 100,
            'payment_method' => PaymentMethodEnum::BANK_BILLET->value,
        ];

        $content = $this->mockCurrencyConversionData('BRL', $payload['target']);
        $this->instance(CurrencyConversionRepository::class, $this->mockCurrencyConversionContractRepository($content));

        $response = $this->postJson(route(self::ROUTE), $payload);

        $response->assertOk()->assertJson([
            'data' => [
                'origin' => 'BRL',
                'target' => $payload['target'],
                'payment_method' => $payload['payment_method'],
                'payment_method_tax' => 145000,
                'conversion_value' => $payload['conversion_value'],
                'conversion_tax' => 100000,
            ]
        ]);
    }
}
