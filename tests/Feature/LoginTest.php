<?php

namespace Tests\Feature;

use Illuminate\Auth\AuthManager;
use Illuminate\Auth\SessionGuard;
use Illuminate\Database\Connection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\NewAccessToken;
use Mockery;
use Modules\Authentication\Http\Requests\RegisterRequest;
use Modules\User\Entities\User;
use Modules\User\Repositories\Contracts\UserRepositoryInterface;
use Modules\User\Repositories\UserRepository;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use PHPUnit\Framework\ExpectationFailedException;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    /**
     * @group session
     * @group login
     */
    public function test_the_login_returns_a_successful_response()
    {
        $user = User::factory()->create();

        $payload = [
            'email' => $user->email,
            'password' => "password"
        ];

        $response = $this->postJson('/api/auth/login', $payload);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @group session
     * @group login
     */
    public function test_the_login_returns_a_unauthorized_response()
    {
        $user = User::factory()->create();

        $payload = [
            'email' => $user->email,
            'password' => "password1"
        ];

        $response = $this->postJson('/api/auth/login', $payload);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
