<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\AuthException;
use App\Facades\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Random\RandomException;

class AuthServices
{
    private static ?User $userAuth;

    /**
     * @throws \Throwable
     * @throws RandomException
     */
    public function authenticate(array $attributes): array
    {
        $token = $this->createToken(attributes: $attributes);

        return [
            'email' => self::$userAuth?->email,
            'token' => $token,
        ];
    }

    /**
     * @throws \Throwable
     * @throws RandomException
     */
    private function createToken(array $attributes): string
    {
        $attempt = Auth::attempt($attributes);
        $user = Auth::user();

        throw_unless(($attempt && $user instanceof User), AuthException::unauthorized());

        self::$userAuth = $user;

        return Helpers::generateToken(user: $user);
    }

    public function verify(): ?array
    {
        return Helpers::authUser()?->toArray();
    }
}
