<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Eloquent\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class AuthService extends BaseService
{
    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(RegisterRequest $request): User
    {
        $newUser = $this->mountUser($request);

        return $this->authRepository->create($newUser);
    }

    public function login(LoginRequest $request): string |JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $token;
    }

    private function mountUser(RegisterRequest $request): array
    {
        return [
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => app('hash')->make($request->input('password')),
        ];
    }
}
