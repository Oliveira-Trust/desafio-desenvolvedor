<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\User\Http\Requests\LoginRequest;
use App\User\Http\Requests\UserRegisterRequest;
use App\User\Http\Resources\UserResource;
use App\User\Services\UserAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthController extends Controller
{
    public function __construct(
        private UserAuthService $userAuthService
    ) {}

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = $this->userAuthService->register($request->validated());

        return response()->json([
            'message' => 'User registered successfully.',
            'user' => new UserResource($user['user']),
            'token' => $user['token'],
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $user->tokens()->delete();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'user' => new UserResource($user),
            'token' => $token,
        ], Response::HTTP_OK);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($request->user()),
        ], Response::HTTP_OK);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout feito com sucesso.',
        ], Response::HTTP_OK);
    }
}
