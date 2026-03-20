<?php

namespace App\Domains\User\Presentation\Http\Controllers;

use App\Domains\User\Application\Services\AuthenticateUserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function login(Request $request, AuthenticateUserService $authService): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = $authService->handle($credentials['email'], $credentials['password']);
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'data' => [
                'token' => $token,
                'user' => $user,
            ],
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        if ($request->hasSession()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return response()->json([
            'message' => 'Logout realizado com sucesso.',
        ], 200);
    }
}
