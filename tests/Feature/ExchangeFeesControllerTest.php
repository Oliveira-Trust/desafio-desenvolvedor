<?php

use App\Models\ExchangeFee;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
    $this->signIn();
});

it('can update exchange fees', function () {

    $exchangeFees = ExchangeFee::create([
        'min_amount' => 1000,
        'max_amount' => 3000,
        'fees' => 2.00,
    ]);

    $response = $this->putJson('/api/exchange-fees', [
        [
            'id' => $exchangeFees->id,
            'min_amount' => $exchangeFees->min_amount,
            'max_amount' => $exchangeFees->max_amount,
            'fees' => 5.00,
        ]
    ]);

    $response->assertStatus(200);

    expect((float) $exchangeFees->fees)->toBe(2.00);
    expect((float) $exchangeFees->fresh()->fees)->toBe(5.00);

});
