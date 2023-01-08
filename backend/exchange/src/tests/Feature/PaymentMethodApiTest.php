<?php

namespace Tests\Feature;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Illuminate\Foundation\Testing\TestCase;

class PaymentMethodApiTest extends TestCase {
    use CreatesApplication;
    use RefreshDatabase;

    protected function shouldSeed() {
        return true;
    }

    public function test_index_route_success_response() {
        $response = $this->get('api/payment_method');
        $response->assertSuccessful();
        $response->assertJsonStructure(
            [
                '*' => [
                    'id',
                    'name',
                    'fee_rate',
                    'created_at',
                    'updated_at',
                ],
            ]
        );

    }

    public function test_show_route_success_response() {
        $payment_method = PaymentMethod::factory()->create();

        $response = $this->get("api/payment_method/{$payment_method->id}");

        $response->assertSuccessful();

        $response->assertJson(['id' => $payment_method->id]);

        $response->assertJsonStructure([
            'id',
            'name',
            'fee_rate',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_update_fee_route_success_response() {

        $payment_method = PaymentMethod::factory()->create([
            'name'     => 'test',
            'fee_rate' => 1,
        ]);

        $response = $this->put("api/payment_method/{$payment_method->id}", [
            'fee_rate' => 1.23,
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('payment_methods', [
            'id'       => $payment_method->id,
            'name'     => 'test',
            'fee_rate' => 1.23,
        ]);

        $response->assertJsonStructure([
            'id',
            'name',
            'fee_rate',
            'created_at',
            'updated_at',
        ]);
    }

}
