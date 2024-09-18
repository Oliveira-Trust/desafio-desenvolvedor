<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService,
    ){}

    public function token(Request $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        $user = $this->authService->authenticateUser($credentials);
        if(is_null($user))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        return response()->json([
            'token' => $user->plainTextToken
        ]);
    }
}
