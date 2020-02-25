<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Auth and register users controller.
 */
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'new']]);
    }

    /**
     * Handle login.
     */
    public function login (Request $request): JsonResponse
    {
        $input = $request->only('email', 'password');

        if (!auth()->attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos.',
            ], 401);
        }

        return $this->check();
    }

    /**
     * Register new user.
     */
    public function new (RegistrationFormRequest $request): JsonResponse
    {
        try {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
    
            return $this->login($request);
        } catch (\PDOException $e) {
            return response()->json([
                'error' => 'Não foi possível criar o registro.'
            ]);
        }
    }

    /**
     * Handle logout.
     */
    public function logout (): JsonResponse
    {
        auth()->logout();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * Refresh a token.
     */
    public function refresh(): JsonResponse
    {
        return response()->json(auth()->refresh());
    }

    /**
     * Check user logged.
     */
    public function check(): JsonResponse
    {
        return response()->json([
            'logged' => auth()->check(),
            'access_token' => auth()->tokenById(auth()->user()->id),
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }
}
