<?php
namespace App\Domains\User\Application\Ports;

interface PasswordHasher
{
    public function verify(string $plain, string $hashed): bool;
}