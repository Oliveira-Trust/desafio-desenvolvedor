<?php

namespace Tests\Feature;

use Domain\Fees\Models\Fees;
use Domain\PaymentMethod\Models\PaymentMethod;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function mockFees()
    {
        $paymentType = [
            'name' => 'boleto',
            'display_name' => 'Boleto'
        ];

        $paymentType = PaymentMethod::create($paymentType);

        $taxe = [
            'payment_method_id' => $paymentType->id,
            'percentage' => 1.74,
        ];

        Fees::create($taxe);
    }

    public function test_create_new_purchase()
    {
        $this->mockFees();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/v1/purchases', [
            "origin" => "BRL",
            "destiny" => "USD",
            "value" => 2400,
            "payment_method" => "boleto"
        ]);

        $response->assertStatus(201);
    }

    public function test_return_all_user_purchase()
    {
        $user = User::factory()->create();
        $this->mockFees();

        $response = $this->actingAs($user)->get('v1/purchases');

        $response->assertStatus(200);
    }


}
