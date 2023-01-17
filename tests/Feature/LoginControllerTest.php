<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginReturnToken()
    {
        $response = $this->post('/api/login',[
            "email"=> "alan.iago.ar@gmail.com",
            "password"=> "123"
        ])
            ->assertOk();

        $this->assertArrayHasKey("token", $response->json());
    }
}
