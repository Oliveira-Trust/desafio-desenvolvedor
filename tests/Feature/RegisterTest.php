<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_register_new_user()
    {
        $payload = [
            'email' => 'novo@teste.com',
            'name' => 'new user',
            'password' => 'password'
        ];

        $response = $this->postJson('/api/user-register', $payload);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'error' => ''
        ]);
    }

    public function test_user_can_authenticate()
    {
        $payload1 = [
            'email' => 'novo@teste.com',
            'name' => 'new user',
            'password' => 'password'
        ];
        $this->postJson('/api/user-register', $payload1);

        $payload = [
            'email' => 'novo@teste.com',
            'password' => 'password'
        ];

        $response = $this->postJson('/api/user-login', $payload);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'error' => ''
        ]);
    }

}
