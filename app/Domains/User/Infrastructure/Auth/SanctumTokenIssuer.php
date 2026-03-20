<?php

namespace App\Domains\User\Infrastructure\Auth;

use App\Domains\User\Application\Ports\TokenIssuer;
use App\Domains\User\Infrastructure\Persistence\Eloquent\User;

final class SanctumTokenIssuer implements TokenIssuer
{
    public function issueForUserId(int $userId, string $tokenName = 'api-token'): string
    {
        $user = User::query()->findOrFail($userId);

        return $user->createToken($tokenName)->plainTextToken;
    }
}