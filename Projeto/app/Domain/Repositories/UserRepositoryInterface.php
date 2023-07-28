<?php
// app/Domain/Repositories/UserRepositoryInterface.php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}
