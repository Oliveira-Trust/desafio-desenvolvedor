<?php

namespace Tests\Feature;

use Domain\Fees\Models\Fees;
use Domain\PaymentMethod\Models\PaymentMethod;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeesTest extends TestCase
{
    use RefreshDatabase;

    public function mockFees()
    {
        $paymentMethod = [
            'name' => 'boleto',
            'display_name' => 'Boleto'
        ];

        $createPaymentMethod = PaymentMethod::create($paymentMethod);

        $fees = [
            'payment_method_id' => $createPaymentMethod->id,
            'percentage' => 1.74,
        ];

        return Fees::create($fees);
    }

    public function test_find_one_fees()
    {
        $user = User::factory()->create();
        $fees = $this->mockFees();

        $response = $this->actingAs($user)->get('/v1/fees/'.$fees->id);

        $response->assertStatus(200);
    }

    public function test_update_one_fees()
    {
        $user = User::factory()->create();
        $fees = $this->mockFees();

        $feesData = ['percentage' => 3.54];

        $response = $this->actingAs($user)->put('/v1/fees/'.$fees->id, $feesData);

        $response->assertStatus(204);
    }
}
