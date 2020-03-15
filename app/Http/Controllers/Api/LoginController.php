<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();

        if($data['password'] !== $data['password_confirmation'])
            return response()->json(['error' => 'Senhas diferentes']);

        $user = new User;

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        $data['password'] = Hash::make($data['password']);

        $user = $user->create($data);

        $token = auth('api')->attempt($credentials);

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Não Autorizado'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Logout Efetuado com Sucesso']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
