<?php declare(strict_types=1);

namespace Auth;

use App\Models\User;
use Tests\TestCase;
use Tests\Traits\RefreshMongoDatabase;

final class ApiAuthTest extends TestCase
{
    use RefreshMongoDatabase;

    // ── Register ──────────────────────────────────────────────────────────────

    public function test_user_can_register(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
        ]);

        $response->assertCreated()
            ->assertJsonStructure([
                'message',
                'token',
                'user' => ['id', 'name', 'email'],
            ]);

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    public function test_register_fails_with_duplicate_email(): void
    {
        User::factory()->create(['email' => 'john@example.com']);

        $this->postJson('/api/auth/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_register_fails_with_weak_password(): void
    {
        $this->postJson('/api/auth/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => '123',
            'password_confirmation' => '123',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);
    }

    // ── Login ─────────────────────────────────────────────────────────────────

    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('secret1234'),
        ]);

        $this->postJson('/api/auth/login', [
            'email' => 'john@example.com',
            'password' => 'secret1234',
        ])->assertOk()
            ->assertJsonStructure(['message', 'token']);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        User::factory()->create(['email' => 'john@example.com']);

        $this->postJson('/api/auth/login', [
            'email' => 'john@example.com',
            'password' => 'wrongpassword',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    // ── Logout ────────────────────────────────────────────────────────────────

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('secret1234'),
        ]);

        $token = auth('api')->login($user);

        $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/auth/logout')
            ->assertOk()
            ->assertJson(['message' => 'Logout realizado com sucesso.']);
    }

    public function test_protected_routes_require_authentication(): void
    {
        $this->getJson('/api/files')->assertUnauthorized();
        $this->getJson('/api/instruments')->assertUnauthorized();
    }
}
