<?php

declare(strict_types=1);

namespace Tests\Feature;

use AllowDynamicProperties;
use App\Connections\Clients\Economy\Routes;
use App\Enumerators\Exceptions;
use App\Facades\Helpers;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * @property $userToken
 */
#[AllowDynamicProperties] class EconomyQuotationExceptionFeatureTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userToken = Helpers::generateToken(User::factory()->create([
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password',
        ]));

        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer ' . $this->userToken;

        Http::fake([
            Routes::COMBINATIONS => Http::response([], Response::HTTP_OK),
            Routes::QUOTATION . '*' => Http::response([], Response::HTTP_OK),
        ]);
    }

    public function test_should_return_combinations_not_found(): void
    {
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->userToken,
        ])->get('api/combinations')
            ->assertJson(["message" => __('exceptions.' . Exceptions::COMBINATIONS_NOT_FOUND->value)])
            ->assertStatus(Response::HTTP_NOT_FOUND);

    }

    public function test_should_return_quotation_not_found(): void
    {
        Payment::factory()->create([
            'slug' => 'bank-slip',
            'rate' => 1.45
        ]);

        $this->post('api/conversion', [
            'from' => 'BRL',
            'to' => 'USD',
            'payment' => 'bank-slip',
            'amount' => 5000
        ])
            ->assertJson(["message" => __('exceptions.' . Exceptions::QUOTATIONS_NOT_FOUND->value)])
            ->assertStatus(Response::HTTP_NOT_FOUND);

    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($_SERVER['HTTP_AUTHORIZATION']);
    }
}
