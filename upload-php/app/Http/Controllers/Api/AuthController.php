<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function auth(AuthRequest $request)
    {
        $credentials = $request->validated();

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        $user->api_token = Str::random(60);
        $user->save();

        return response()->json(['token' => $user->api_token]);
    }
}
