<?php

namespace App\Domains\User\Infrastructure\Persistence\Eloquent;

use App\Domains\User\Application\Ports\UserRepository;
use App\Domains\User\Domain\Entities\User as DomainUser;

final class EloquentUserRepository implements UserRepository
{
    public function findByEmail(string $email): ?DomainUser
    {
        $user = User::query()->where('email', $email)->first();

        if (! $user) {
            return null;
        }

        return new DomainUser(
            id: (int) $user->id,
            name: (string) $user->name,
            email: (string) $user->email,
            passwordHash: (string) $user->password,
        );
    }
}
