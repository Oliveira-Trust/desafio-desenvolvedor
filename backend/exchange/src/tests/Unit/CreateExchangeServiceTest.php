<?php

namespace Tests\Unit;

use App\Models\Currency;
use App\Models\Exchange;
use App\Models\PaymentMethod;
use App\Services\CreateExchangeService;
use Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class CreateExchangeServiceTest extends TestCase {
    use CreatesApplication;
    use RefreshDatabase;

    protected function shouldSeed() {
        return true;
    }

    public function test_exchange() {

        $mocked_response = json_encode(
            [
                [
                    "code"   => "EUR",
                    "codein" => "BRL",
                    "name"   => "Euro/Real Brasileiro",
                    "high"   => "5.30",
                ],
            ]);

        Http::fake([
            config('api.exchange_rate_check.awesome_api_url') . '*' => Http::response($mocked_response, 200),
        ]);

        $payment_method       = PaymentMethod::first();
        $origin_currency      = Currency::where('code', 'BRL')->first();
        $destination_currency = Currency::where('code', 'EUR')->first();

        $service = (new CreateExchangeService(
            user_id: 1,
            origin_currency_id: $origin_currency->id,
            destination_currency_id: $destination_currency->id,
            payment_method_id: $payment_method->id,
            origin_value: 5000
        ));

        $result = $service->execute();

        $this->assertInstanceOf(Exchange::class, $result);
        $this->assertDatabaseCount('exchanges', 1);
        $this->assertDatabaseHas('exchanges', [
            "user_id"                   => 1,
            "origin_currency_id"        => $origin_currency->id,
            "destination_currency_id"   => $destination_currency->id,
            "payment_method_id"         => $payment_method->id,
            "origin_value"              => 5000,
            "origin_value_without_fees" => 4877.5,
            "purchased_value"           => 920.28,
            "destination_exchange_rate" => 5.3,
            "payment_method_fee_value"  => 72.5,
            "exchange_fee_value"        => 50.0,
        ]);

    }
}
