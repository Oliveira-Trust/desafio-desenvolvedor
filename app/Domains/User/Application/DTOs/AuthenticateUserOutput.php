<?php

namespace App\Domains\User\Application\DTOs;

final class AuthenticateUserOutput
{
    public function __construct(
        public readonly ?string $accessToken,
        public readonly int $userId,
        public readonly string $userName,
        public readonly string $userEmail,
    ) {}
}
