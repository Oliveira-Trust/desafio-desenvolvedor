<?php
// app/Services/AuthService.php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;

class AuthService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(string $email, string $password): void
    {
        $hashedPassword = Hash::make($password);

        $this->userRepository->create([
            'email' => $email,
            'password' => $hashedPassword,
        ]);
    }

    public function login(string $email, string $password): void
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Assumindo que você está usando o Laravel's built-in authentication
        auth()->login($user);
    }

    public function user()
    {
        // Retorna o usuário atualmente autenticado
        return auth()->user();
    }
}
