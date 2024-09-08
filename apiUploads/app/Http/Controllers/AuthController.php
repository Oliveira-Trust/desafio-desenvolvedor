<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Token;
use Illuminate\Support\Str;



class AuthController extends Controller
{
    public function generateToken(Request $request)
    {
        // Gere um token único
        $token = Str::random(60);

        // Salve o token no banco de dados
        Token::create(['token' => $token]);

        return response()->json(['token' => $token], 201);
    }
}
