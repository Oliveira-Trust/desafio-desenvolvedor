<?php

use App\Mail\QuoteCreated;
use App\Support\Money;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

beforeEach(function () {
   $this->signIn();
   $this->seed(DatabaseSeeder::class);
});

it('returns a list of available currencies', function () {
    $response = $this->getJson('/api/currencies');
    $response->assertStatus(200)
             ->assertJsonCount(3)
             ->assertJson(['USD', 'EUR', 'RUB']);
});

it('can quote and convert origin currency', function () {

    Http::fake([
        'https://economia.awesomeapi.com.br/last/BRL-USD' => [
           "BRLUSD" => [
               "bid" => "0.20",
               "ask" => "0.20",
           ]
        ]
    ]);

    $response = $this->postJson('/api/quotes', [
        'amount' => 5000,
        'origin_currency' => 'BRL',
        'destination_currency' => 'USD',
        'payment_method' => 'billet'
    ]);

   $response->assertCreated()
       ->assertJson(fn (AssertableJson $json) =>
              $json->where('data.origin_currency', 'BRL')
                   ->where('data.destination_currency', 'USD')
                   ->where('data.amount', (new Money(5000))->format('BRL'))
                   ->where('data.payment_method', __('billet'))
                   ->where('data.amount_received', (new Money(975.5))->format('USD'))
                   ->where('data.amount_converted', (new Money(4877.50))->format('BRL'))
                   ->where('data.payment_method_fee', (new Money(72.50))->format('BRL'))
                   ->where('data.conversion_fee', (new Money(50))->format('BRL'))
                   ->etc()
       );
});

it('can quote and convert origin currency with credit card', function () {

    Http::fake([
        'https://economia.awesomeapi.com.br/last/BRL-USD' => [
           "BRLUSD" => [
               "bid" => "0.20",
               "ask" => "0.20",
           ]
        ]
    ]);

    $response = $this->postJson('/api/quotes', [
        'amount' => 5000,
        'origin_currency' => 'BRL',
        'destination_currency' => 'USD',
        'payment_method' => 'credit-card'
    ]);

   $response->assertCreated()
       ->assertJson(fn (AssertableJson $json) =>
             $json->where('data.amount_received', (new Money(913.70))->format('USD'))
                   ->etc()
       );
});

it('cannot quote if amount is less than 1000 BRL', function () {

    Http::fake([
        'https://economia.awesomeapi.com.br/last/BRL-USD' => [
           "BRLUSD" => [
               "bid" => "0.20",
               "ask" => "0.20",
           ]
        ]
    ]);

    $response = $this->postJson('/api/quotes', [
        'amount' => 999,
        'origin_currency' => 'BRL',
        'destination_currency' => 'USD',
        'payment_method' => 'credit-card'
    ]);

   $response->assertStatus(422)
       ->assertJson(fn (AssertableJson $json) =>
             $json->where('errors.amount.0', 'O valor mínimo é de R$ 1000')
                   ->etc()
       );
});

it('cannot quote if amount is greater than 100.000 BRL', function () {
    Http::fake([
        'https://economia.awesomeapi.com.br/last/BRL-USD' => [
            "BRLUSD" => [
                "bid" => "0.20",
                "ask" => "0.20",
            ]
        ]
    ]);

    $response = $this->postJson('/api/quotes', [
        'amount' => 350_000,
        'origin_currency' => 'BRL',
        'destination_currency' => 'USD',
        'payment_method' => 'credit-card'
    ]);

    $response->assertStatus(422)
        ->assertJson(fn (AssertableJson $json) =>
        $json->where('errors.amount.0', 'O valor máximo é de R$ 100000')
            ->etc()
        );
});

it('sends the quote by email to the user', function () {

    Mail::fake();

    Http::fake([
        'https://economia.awesomeapi.com.br/last/BRL-USD' => [
            "BRLUSD" => [
                "bid" => "0.20",
                "ask" => "0.20",
            ]
        ]
    ]);

    $response = $this->postJson('/api/quotes', [
        'amount' => 1000,
        'origin_currency' => 'BRL',
        'destination_currency' => 'USD',
        'payment_method' => 'credit-card'
    ]);

    $response->assertCreated();

    Mail::assertSent(QuoteCreated::class);
});
