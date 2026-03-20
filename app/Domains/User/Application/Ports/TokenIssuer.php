<?php
namespace App\Domains\User\Application\Ports;

interface TokenIssuer
{
    public function issueForUserId(int $userId, string $tokenName = 'api-token'): string;
}