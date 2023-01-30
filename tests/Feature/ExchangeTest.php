<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExchangeTest extends TestCase
{

    use RefreshDatabase;

    public function test_exchange_fails_if_not_authenticated()
    {
        $payload = [
        ];

        $response = $this->postJson('/api/exchange', $payload);

        $response->assertStatus(401);
        $response->assertJsonFragment([
            'message' => 'Unauthenticated.'
        ]);
    }

    public function test_valid_exchange_succedes()
    {
        Sanctum::actingAs($this->user);

        $payload = [
            'currency' => 'USD',
            'payment_method' => 'Slip',
            'ammount' => 5000
        ];

        $response = $this->postJson('/api/exchange', $payload);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'currency' => 'USD'
        ]);
    }

    public function test_invalid_exchange_currency_fails()
    {
        Sanctum::actingAs($this->user);

        $payload = [
            'currency' => 'XXX',
            'payment_method' => 'Slip',
            'ammount' => 5000
        ];

        $response = $this->postJson('/api/exchange', $payload);

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'The selected currency is invalid.'
        ]);
    }

    public function test_invalid_exchange_method_fails()
    {
        Sanctum::actingAs($this->user);

        $payload = [
            'currency' => 'USD',
            'payment_method' => 'xxx',
            'ammount' => 5000
        ];

        $response = $this->postJson('/api/exchange', $payload);

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'The selected payment method is invalid.'
        ]);
    }

    public function test_invalid_exchange_ammount_fails()
    {
        Sanctum::actingAs($this->user);

        $payload = [
            'currency' => 'USD',
            'payment_method' => 'Slip',
            'ammount' => 10
        ];

        $response = $this->postJson('/api/exchange', $payload);

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'The ammount must be at least 1000.'
        ]);
    }

    public function test_can_list_exchanges()
    {
        Sanctum::actingAs($this->user);

        $payload = [
            'currency' => 'USD',
            'payment_method' => 'Slip',
            'ammount' => 5000
        ];

        $this->postJson('/api/exchange', $payload);

        $response = $this->getJson('/api/exchange');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'currency' => 'USD'
        ]);
        $response->assertJsonCount(1, 'data');

    }


}
