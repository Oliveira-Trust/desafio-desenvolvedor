<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function showViewLogin()
    {
        return view('auth.login');
    }
    public function login()
    {        
        return redirect()->route('conversion');
    }    
    public function apiLogin(Request $request)
    {   
        $credentials = $request->only(['email', 'password']);       
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(["token" => $token]);
    }    
    
}
