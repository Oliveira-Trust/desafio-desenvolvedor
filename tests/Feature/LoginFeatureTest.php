<?php

declare(strict_types=1);

namespace Tests\Feature;

use AllowDynamicProperties;
use App\Enumerators\Exceptions;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

/**
 * @property array|string[] $payload
 */
#[AllowDynamicProperties] class LoginFeatureTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        $this->payload = [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'test@example.com',
            'password' => 'password',
        ];
    }

    public function test_should_logged_in_user(): void
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->post('api/login', $this->payload)
            ->assertJsonStructure(['email', 'token'])
            ->assertOk();
    }

    public function test_should_return_not_found_when_has_no_verified_user(): void
    {
        $this->get('api/login/verify', $this->payload)
            ->assertJson([
                'message' => __('exceptions.' . Exceptions::NOT_FOUND->value),
            ])->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @throws \JsonException
     */
    public function test_should_verify_logged_user(): void
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response = $this->post('api/login', $this->payload)
            ->assertJsonStructure(['email', 'token'])
            ->assertOk();

        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer ' . json_decode(
            $response->content(),
            true,
            512,
            JSON_THROW_ON_ERROR
        )['token'] ?? '';

        $this->get('api/login/verify')->assertJson([
            'name' => 'John Doe',
            'email' => 'test@example.com',
        ])->assertOk();

        unset($_SERVER['HTTP_AUTHORIZATION']);
    }

    public function test_should_throw_exception_when_log_in_user(): void
    {
        $this->post('api/login', $this->payload)->assertJson([
            'shortMessage' => Exceptions::UNAUTHORIZED->value,
            'message' => __('auth.' . Exceptions::UNAUTHORIZED->value),
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
