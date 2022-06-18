<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthenticationTest extends TestCase {

    public function test_must_enter_email_and_password()
    {
        $this->json('POST', 'auth/login')
             ->assertStatus(422)
             ->assertJson([
                 'message' => 'The email field is required. (and 1 more error)',
                 'errors'  => [
                     "email" => ['The email field is required.'],
                     "password" => ['The password field is required.'],
                 ]
             ]);
    }

    public function test_must_wrong_username_or_password()
    {
        $loginData = ['email' => 'user@user.com', 'password' => 'user'];

        $this->json('POST', 'auth/login', $loginData)
             ->assertStatus(422)
             ->assertJson([
                 'message' => 'These credentials do not match our records.',
                 'errors'  => [
                     'email' => ['These credentials do not match our records.'],
                 ]
             ]);
    }

    public function test_must_successful_login()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();

        $loginData = ['email' => $user->email, 'password' => $user->email];

        $this->json('POST', 'auth/login', $loginData)
             ->assertStatus(200)
             ->assertJsonPath('success', true)
             ->assertJsonPath('user.email', $user->email)
             ->assertJsonStructure(['success', 'user', 'token']);
    }

    public function test_must_logout_fail()
    {
        $this->json('POST', 'auth/logout')
             ->assertStatus(401)
             ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function test_must_successful_logout()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $this->json('POST', 'auth/logout')
             ->assertStatus(200)
             ->assertJson(['success' => true]);
    }

    public function test_must_successful_logout_with_token()
    {
        $user  = \Oliveiratrust\Models\User\User::factory()->create();
        $token = $user->createToken('authtoken');

        $this->assertEquals(1, $user->tokens()->count());

        $this->withHeaders(['Authorization' => "Bearer $token->plainTextToken"])
             ->json('POST', 'auth/logout')
             ->assertStatus(200)
             ->assertJson(['success' => true]);

        $this->assertEquals(0, $user->tokens()->count());
    }
}
