<?php

namespace App\Domains\User\Presentation\Http\Controllers;

use App\Domains\User\Exceptions\InvalidCredentialsException;
use App\Domains\User\Presentation\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Shared\Responses\ApiSuccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        if (! Auth::guard('web')->attempt($request->credentials())) {
            throw new InvalidCredentialsException();
        }

        $request->session()->regenerate();

        $user = Auth::guard('web')->user();

        return ApiSuccess::make(
            data: [
                'user' => [
                    'id' => $user->getAuthIdentifier(),
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ],
            message: 'Login realizado com sucesso.'
        );
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return ApiSuccess::make(
            message: 'Logout realizado com sucesso.'
        );
    }
}
