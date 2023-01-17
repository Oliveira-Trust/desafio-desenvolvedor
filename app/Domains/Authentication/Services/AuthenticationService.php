<?php

namespace App\Domains\Authentication\Services;

use App\Domains\User\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthenticationService
{
    public function __construct(public UserService $userService)
    {
    }

    public function login(string $password, string $email) : string
    {
        $userExists = Auth::attempt(["email" => $email, "password" => $password]);

        if(!$userExists){
            $user = $this->userService->create($email, $password);
            return $user->createToken("api_token")->plainTextToken;
        }

        $user = Auth::user();
        return $user->createToken("api_token")->plainTextToken;
    }
}
