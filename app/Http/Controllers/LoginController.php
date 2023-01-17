<?php

namespace App\Http\Controllers;

use App\Domains\Authentication\Services\AuthenticationService;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function __construct(public AuthenticationService $loginService)
    {

    }

    public function login(LoginRequest $request)
    {
        $password = $request->password;
        $email = $request->email;

        try{
            $token = $this->loginService->login($password, $email);
            return response()->json([
                "token" => $token
            ]);
        }catch (\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 500);
        }

    }
}
