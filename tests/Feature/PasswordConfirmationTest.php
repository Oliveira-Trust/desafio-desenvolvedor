<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $user = User::factory()->withPersonalTeam()->create();

        $response = $this->actingAs($user,'web')->get('/user/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user,'web')->post('/user/confirm-password', [
            'password' => 'password!@#$123456',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password!@#$123456',
        ]);

        $this->assertAuthenticated('web');

        $response = $this->actingAs($user,'web')->post('/user/confirm-password', [
            'password' => 'wrong-password-test',
        ]);
        
        $response->assertSessionHasErrors();
    }
}
