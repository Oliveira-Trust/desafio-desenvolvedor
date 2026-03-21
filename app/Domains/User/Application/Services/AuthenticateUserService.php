<?php

namespace App\Domains\User\Application\Services;

use App\Domains\User\Application\DTOs\AuthenticateUserInput;
use App\Domains\User\Application\DTOs\AuthenticateUserOutput;
use App\Domains\User\Application\Ports\PasswordHasher;
use App\Domains\User\Application\Ports\TokenIssuer;
use App\Domains\User\Application\Ports\UserRepository;
use App\Domains\User\Exceptions\InvalidCredentialsException;

final class AuthenticateUserService
{
    public function __construct(
        private readonly UserRepository $users,
        private readonly PasswordHasher $hasher,
        private readonly TokenIssuer $tokens,
    ) {}

    public function handle(AuthenticateUserInput $input, bool $issueToken = true): AuthenticateUserOutput
    {
        $email = mb_strtolower(trim($input->email));
        $user = $this->users->findByEmail($email);

        if (! $user) {
            throw new InvalidCredentialsException();
        }

        if (! $this->hasher->verify($input->password, $user->passwordHash)) {
            throw new InvalidCredentialsException();
        }

        $accessToken = $issueToken
            ? $this->tokens->issueForUserId($user->id, 'api-token')
            : null;

        return new AuthenticateUserOutput(
            accessToken: $accessToken,
            userId: (int) $user->id,
            userName: (string) $user->name,
            userEmail: (string) $user->email,
        );
    }
}
