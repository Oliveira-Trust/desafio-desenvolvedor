<?php

namespace App\Domains\User\Presentation\Http\Controllers;

use App\Domains\User\Application\DTOs\AuthenticateUserInput;
use App\Domains\User\Application\Services\AuthenticateUserService;
use App\Http\Controllers\Controller;
use App\Shared\Responses\ApiSuccess;
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

        $output = $authService->handle(
            new AuthenticateUserInput(
                email: $credentials['email'],
                password: $credentials['password'],
            )
        );

        return ApiSuccess::make(
            data: [
                'token' => $output->accessToken,
                'user' => [
                    'id' => $output->userId,
                    'name' => $output->userName,
                    'email' => $output->userEmail,
                ],
            ],
            message: 'Login realizado com sucesso.'
        );
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        if ($request->hasSession()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return ApiSuccess::make(
            message: 'Logout realizado com sucesso.'
        );
    }
}
