<?php
namespace App\Domains\User\Application\Ports;

use App\Domains\User\Domain\Entities\User;

interface UserRepository
{
    public function findByEmail(string $email): ?User;
}