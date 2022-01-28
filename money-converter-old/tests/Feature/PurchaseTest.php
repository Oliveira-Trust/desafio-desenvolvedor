<?php

namespace Tests\Feature;

use App\Models\PaymentType;
use App\Models\Purchase;
use App\Models\Taxe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function purchaseMock(): void
    {
        $paymentType = PaymentType::factory()->create();
        Taxe::create(['payment_type_id' => $paymentType->id, 'percentage' => 1.74]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_purchase()
    {
        $data = [
            'origin' => 'BRL',
            'destiny' => 'USD',
            'value' => 2400,
            'payment_type' => 'boleto',
        ];

        $user = User::factory()->create();
        $this->purchaseMock();

        $response = $this->actingAs($user)->post('/v1/purchase', $data);

        $response->assertStatus(201);
    }

    public function test_list_all_user_purchase()
    {
        $user = User::factory()->create();
        $this->purchaseMock();

        $response = $this->actingAs($user)->get('v1/purchase');

        $response->assertStatus(200);
    }
}
