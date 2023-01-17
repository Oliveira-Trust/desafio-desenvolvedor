<?php

namespace Tests\Feature;

use App\Domains\Authentication\Services\AuthenticationService;
use Tests\TestCase;

class ExchangeControllerTest extends TestCase
{
    public string $token;

    public function testCreateExchangeSuccess()
    {
        $response = $this->post('/api/exchange', [
            "currency_from_id" => 1,
            "currency_to_id" => 2,
            "amount" => 2000,
            "payment_method_id" => 1
        ],[
            "Authorization" => "Bearer {$this->token}",
            "Accept" => "application/json"
        ]);


        $this->assertArrayHasKey("data", $response->json());
    }

    public function setUp(): void
    {
        parent::setUp();
        $authenticationService = app(AuthenticationService::class);
        $this->token = $authenticationService->login("123", "alan.iago.ar@gmail.com");
    }
}
