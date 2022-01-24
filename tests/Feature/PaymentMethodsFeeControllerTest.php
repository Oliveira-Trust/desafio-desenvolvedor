<?php

use App\Models\PaymentMethod;
use Database\Seeders\PaymentMethodsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
   $this->seed(PaymentMethodsSeeder::class);
   $this->signIn();
});

it('can update the fees for the given payment method', function () {
    $paymentMethod = PaymentMethod::whereSlug('billet')->first();

    $response = $this->putJson('/api/payment-methods-fee', [
        [
            'slug' => $paymentMethod->slug,
            'fees' => 3.00,
        ]
    ]);

    $response->assertStatus(200);

    expect((float) $paymentMethod->fees)->toBe(1.45);
    expect((float) $paymentMethod->fresh()->fees)->toBe(3.00);

});
