<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function authenticate(Request $request) {

        // A string está em uma variável do .env, porém não consehui utilizá-la aqui
        $password_insert = $request->password.'f475e39ecb9a30f279c9c9e3f78edd1c';
        $token_password = md5($password_insert);

        $email = User::where('email',$request->email)->get();
        $password = User::where('password', $token_password)->get();

        if(count($email) == 0 || count($password) == 0)
            return response()->json(['Response' => 'Email or password incorrect.'], 400);

        else
            return response()->json(['Response' => 'User authenticate with success.'], 200);
    }
}
