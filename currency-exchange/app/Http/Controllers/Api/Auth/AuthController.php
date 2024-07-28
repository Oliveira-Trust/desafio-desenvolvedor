<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(RegisterRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $hashedPassword = Hash::make($payload['password']);
        $user = User::create([...$payload, 'password' => $hashedPassword]);

        return response()->json([
            'data'          => $user,
            'access_token'  => $user->createToken('auth_token')->plainTextToken,
            'token_type'    => 'Bearer'
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        $user   = User::where('email', $credentials['email'])->firstOrFail();
        $token  = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data'          => $user,
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ]);
    }

    public function logout(): JsonResponse
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json(null, 204);
    }
}
