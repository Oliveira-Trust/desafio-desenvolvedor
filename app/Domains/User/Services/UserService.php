<?php

namespace App\Domains\User\Services;

use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(string $email, string $password) : User
    {
        $user = User::create(["email" => $email, "password" => Hash::make($password)]);

        return $user;
    }
}
