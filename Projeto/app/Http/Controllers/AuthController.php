
<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\RegisterUseCase;
use App\UseCases\LoginUseCase;
use Exception;

class AuthController extends Controller
{
    private $registerUseCase;
    private $loginUseCase;

    public function __construct(RegisterUseCase $registerUseCase, LoginUseCase $loginUseCase)
    {
        $this->registerUseCase = $registerUseCase;
        $this->loginUseCase = $loginUseCase;
    }

    public function register(Request $request)
    {
        try {
            $user = $this->registerUseCase->execute(
                $request->input('name'),
                $request->input('email'),
                $request->input('password')
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {
        try {
            $token = $this->loginUseCase->execute(
                $request->input('email'),
                $request->input('password')
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['token' => $token]);
    }
}
