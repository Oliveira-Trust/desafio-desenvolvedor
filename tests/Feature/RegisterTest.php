<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\NewAccessToken;
use Modules\Authentication\Http\Requests\RegisterRequest;
use Modules\User\Entities\User;
use Modules\User\Repositories\Contracts\UserRepositoryInterface;
use Modules\User\Repositories\UserRepository;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use WithFaker;

    /**
     * @group session
     * @group register
     */
    public function test_the_auth_register_returns_a_successful_response()
    {
        $payload = [
            'name'  => $this->faker->firstName,
            'email' => $this->faker->email,
            'password' => $this->faker->password(),
            'password_confirmation' => $this->faker->password(),
            'is_admin' => $this->faker->boolean()
        ];

        $token = $this->createPartialMock(NewAccessToken::class, ['toArray', 'toJson']);

        $mockUser = $this->createPartialMock(User::class, ['createToken']);
        $mockUser->expects($this->once())->method('createToken')->willReturn($token);
        $mockUser->created_at = now();

        $mockRepository = $this->createPartialMock(UserRepository::class, ['create']);
        $mockRepository->expects($this->once())->method('create')->willReturn($mockUser);

        $this->mock(RegisterRequest::class, function ($mock) use ($payload) {
            $mock->shouldReceive('passes')->andReturn(true);
            $mock->shouldReceive('all')->andReturn($payload);
        });

        $this->instance(UserRepositoryInterface::class, $mockRepository);

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(Response::HTTP_CREATED);
    }
}
