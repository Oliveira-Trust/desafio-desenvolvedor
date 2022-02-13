<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function registerAction(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->authService->register($request);

            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }

    public function loginAction(LoginRequest $request): JsonResponse
    {
        try {
            $token = $this->authService->login($request);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error'], 404);
        }

        return $this->respondWithToken($token);
    }
}
