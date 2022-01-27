<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class QuoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_return_status_200_ok(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->json('GET', '/home')
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_should_return_json_of_quote_and_status_200_ok(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->json('POST', '/generate-quote', $this->getPayload())
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($this->jsonResult());
    }

    public function test_should_return_object_paginator(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->json('GET', '/quote-history')
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_should_return_an_array_empty_and_status_200_ok(): void
    {
        Mail::fake();

        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->json('GET', '/send-email')
            ->assertOk()
            ->assertJson([]);
    }

    /** @return mixed[] */
    private function jsonResult(): array
    {
        return [
            'currency' => 'Dólar Americano',
            'value' => 10000,
            'methodPayment' => 'credit_card',
            'priceCurrency' => 0.1832,
            'finalValue' => 1673.8984,
            'methodPaymentFee' => 763.0000000000001,
            'conversionFee' => 100,
            'discountedValue' => 9137
        ];
    }

    /** @return mixed[] */
    private function getPayload(): array
    {
        return [
            'destination_currency' => 'BRL-AUD',
            'money'                => 10000,
            'payment'              => 'credit_card'
        ];
    }
}