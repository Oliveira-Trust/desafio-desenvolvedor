<?php

namespace App\Domains\User\Application\Services;

use App\Domains\User\Exceptions\InvalidCredentialsException;
use App\Domains\User\Infrastructure\Persistence\Eloquent\User;
use Illuminate\Support\Facades\Hash;

class AuthenticateUserService
{
    public function handle(string $email, string $password): User
    {
        $user = User::query()->where('email', $email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            throw new InvalidCredentialsException();
        }

        return $user;
    }
}