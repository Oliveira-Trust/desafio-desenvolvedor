<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function authenticateUser(array $credentials)
    {
        if (Auth::attempt($credentials) === false) {
            return null;
        }

        $user = Auth::user();
        $user->tokens()->delete();
        return $user->createToken('token');
    }
}
