<?php

namespace App\Domains\User\Domain\Entities;

final class User
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $passwordHash,
    ) {}
}