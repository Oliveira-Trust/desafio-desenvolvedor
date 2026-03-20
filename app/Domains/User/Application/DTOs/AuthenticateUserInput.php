<?php

namespace App\Domains\User\Application\DTOs;

final class AuthenticateUserInput
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {}
}