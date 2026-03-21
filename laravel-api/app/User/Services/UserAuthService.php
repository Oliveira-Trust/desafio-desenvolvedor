<?php

declare(strict_types=1);

namespace App\User\Services;

use App\User\Interfaces\UserRepositoryInterface;
use App\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function register(array $data): array
    {
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $this->userRepository->save($user);

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
