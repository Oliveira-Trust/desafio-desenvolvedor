<?php

namespace Tests\Feature;

use App\Models\PaymentType;
use App\Models\Taxe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaxeTest extends TestCase
{
    use RefreshDatabase;

    public function mockTaxes()
    {
        $paymentType = PaymentType::create([
            'name' => 'boleto',
            'display_name' => 'boleto'
        ]);

        Taxe::create([
            'payment_type_id' => $paymentType->id,
            'percentage' => 1.75,
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_all_taxes()
    {
        $user = User::factory()->create();
        $this->mockTaxes();
        $response = $this->actingAs($user)->get('/v1/taxe');

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }
}
