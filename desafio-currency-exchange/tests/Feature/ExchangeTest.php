<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Domain\Services\ExchangeService;
use App\Domain\Services\PurchaseFeesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Integration\CurrencyQuotes\src\Helpers\PayloadHelper;
use Integration\currencyQuotes\src\Rest;
use Tests\TestCase;

class ExchangeTest extends TestCase
{
    public function test_return_success_payload(): void
    {
        $payload = [
            "current_purchased" => "USD",
        ];

        $response = Rest::lastOccurrence($payload);

        $this->assertTrue($this->count($response['USDBRL']) > 0);
    }

    public function test_return_fail_payload(): void
    {
        $payload = [
            "current_purchased" => "BATATA",
        ];
        $code = '';

        try {
            Rest::lastOccurrence($payload);
        } catch (\Exception $exception) {
            $code = $exception->getCode();
        }

        $this->assertEquals(404, $code);
    }

    public function test_success_value_payment_greater_than_min()
    {
        $exchange = new ExchangeService(new PurchaseFeesService());
        $valueExchange = 5000.0;

        $this->assertTrue($exchange->validateValueExchange($valueExchange));
    }

    public function test_success_value_payment_greater_than_max()
    {
        $exchange = new ExchangeService(new PurchaseFeesService());
        $valueExchange = 99000.0;

        $this->assertTrue($exchange->validateValueExchange($valueExchange));
    }

    public function test_apply_rate_for_value_greater_than_3000_and_type_payment_boleto_exchange()
    {
        $exchange = new ExchangeService(new PurchaseFeesService());
        $payload = [
            "current_purchased" => "USD",
            "type_payment" => "BOLETO",
            "value_exchange" => 5000
        ];

        $response = Rest::lastOccurrence($payload);

        $newPayload = PayloadHelper::consolidatePayload($response, $payload);;
        $newResponse = $exchange->unifyPayloadEnterAndResponseAndApplyRate($newPayload);

        $this->assertEquals(72.5, $newResponse['rate_payment']);
        $this->assertEquals(50.0, $newResponse['rate_value']);
        $this->assertEquals(4877.5, $newResponse['final_value']);
    }

    public function test_apply_rate_for_value_greater_less_3000_and_type_payment_boleto_exchange()
    {
        $exchange = new ExchangeService(new PurchaseFeesService());
        $payload = [
            "current_purchased" => "USD",
            "type_payment" => "BOLETO",
            "value_exchange" => 1500
        ];

        $response = Rest::lastOccurrence($payload);

        $newPayload = PayloadHelper::consolidatePayload($response, $payload);;
        $newResponse = $exchange->unifyPayloadEnterAndResponseAndApplyRate($newPayload);

        $this->assertEquals(21.75, $newResponse['rate_payment']);
        $this->assertEquals(30.0, $newResponse['rate_value']);
        $this->assertEquals(1448.25, $newResponse['final_value']);
    }

    public function test_apply_rate_for_value_greater_less_3000_and_type_payment_credit_card_exchange()
    {
        $exchange = new ExchangeService(new PurchaseFeesService());
        $payload = [
            "current_purchased" => "USD",
            "type_payment" => "CREDIT_CARD",
            "value_exchange" => 2900
        ];

        $response = Rest::lastOccurrence($payload);

        $newPayload = PayloadHelper::consolidatePayload($response, $payload);;
        $newResponse = $exchange->unifyPayloadEnterAndResponseAndApplyRate($newPayload);

        $this->assertEquals(42.05, $newResponse['rate_payment']);
        $this->assertEquals(58.0, $newResponse['rate_value']);
        $this->assertEquals(2799.95, $newResponse['final_value']);
    }

    public function test_apply_rate_for_value_greater_greater_3000_and_type_payment_credit_card_exchange()
    {
        $exchange = new ExchangeService(new PurchaseFeesService());
        $payload = [
            "current_purchased" => "USD",
            "type_payment" => "CREDIT_CARD",
            "value_exchange" => 26000
        ];

        $response = Rest::lastOccurrence($payload);

        $newPayload = PayloadHelper::consolidatePayload($response, $payload);;
        $newResponse = $exchange->unifyPayloadEnterAndResponseAndApplyRate($newPayload);

        $this->assertEquals(377.0, $newResponse['rate_payment']);
        $this->assertEquals(260.0, $newResponse['rate_value']);
        $this->assertEquals(25363.0, $newResponse['final_value']);
    }
}
