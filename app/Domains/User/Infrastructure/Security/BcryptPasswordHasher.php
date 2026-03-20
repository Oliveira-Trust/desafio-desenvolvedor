<?php

namespace App\Domains\User\Infrastructure\Security;

use App\Domains\User\Application\Ports\PasswordHasher;
use Illuminate\Support\Facades\Hash;

final class BcryptPasswordHasher implements PasswordHasher
{
    public function verify(string $plain, string $hashed): bool
    {
        return Hash::check($plain, $hashed);
    }
}