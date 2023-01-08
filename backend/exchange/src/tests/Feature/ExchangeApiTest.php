<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\Exchange;
use App\Models\PaymentMethod;
use Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Illuminate\Foundation\Testing\TestCase;

class ExchangeApiTest extends TestCase {
    use CreatesApplication;
    use RefreshDatabase;

    protected function shouldSeed() {
        return true;
    }

    public function test_index_route_success_response() {
        Exchange::factory(5)->create();

        $response = $this->get('api/exchange');
        $response->assertSuccessful();

        $response->assertJsonCount(5);

        $response->assertJsonStructure(
            [
                '*' => [
                    'id',
                    'user_id',
                    'origin_value',
                    'origin_value_without_fees',
                    'purchased_value',
                    'destination_exchange_rate',
                    'payment_method_fee_value',
                    'exchange_fee_value',
                    'origin_currency_id',
                    'destination_currency_id',
                    'payment_method_id',
                    'created_at',
                    'updated_at',
                ],
            ]
        );

    }

    public function test_index_by_user_id_route_success_response() {

        Exchange::factory(2)->create(['user_id' => 1]);

        Exchange::factory(5)->create(['user_id' => 2]);

        $response = $this->get("api/exchange/by_user_id/2");
        $response->assertSuccessful();

        $response->assertJsonCount(5);

        $response->assertJsonStructure(
            [
                '*' => [
                    'id',
                    'user_id',
                    'origin_value',
                    'origin_value_without_fees',
                    'purchased_value',
                    'destination_exchange_rate',
                    'payment_method_fee_value',
                    'exchange_fee_value',
                    'origin_currency_id',
                    'destination_currency_id',
                    'payment_method_id',
                    'created_at',
                    'updated_at',
                ],
            ]
        );

    }

    public function test_show_route_success_response() {
        $exchange = Exchange::factory()->create();

        $response = $this->get("api/exchange/{$exchange->id}");

        $response->assertSuccessful();

        $response->assertJson(['id' => $exchange->id]);

        $response->assertJsonStructure([
            'id',
            'user_id',
            'origin_value',
            'origin_value_without_fees',
            'purchased_value',
            'destination_exchange_rate',
            'payment_method_fee_value',
            'exchange_fee_value',
            'origin_currency_id',
            'destination_currency_id',
            'payment_method_id',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_create_exchange_route_success_response() {

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

        $origin_currency      = Currency::where('code', 'BRL')->first();
        $destination_currency = Currency::where('code', 'EUR')->first();

        $payment_method = PaymentMethod::factory()->create(['fee_rate' => 1.45]);

        $response = $this->post("api/exchange", [
            'user_id'                 => 1,
            'destination_currency_id' => $destination_currency->id,
            'payment_method_id'       => $payment_method->id,
            'origin_value'            => 5000,
            'email'                   => 'test@test.com',
        ]);

        $response->assertCreated();

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

        $response->assertJsonStructure([
            'id',
            'user_id',
            'origin_value',
            'origin_value_without_fees',
            'purchased_value',
            'destination_exchange_rate',
            'payment_method_fee_value',
            'exchange_fee_value',
            'origin_currency_id',
            'destination_currency_id',
            'payment_method_id',
            'created_at',
            'updated_at',
        ]);
    }

}
