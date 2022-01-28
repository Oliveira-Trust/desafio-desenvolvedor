<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    
    public function login(LoginRequest $request)
    {
        
        $obLogin = $request->validated();
    
        $credentials = [
            'email' => $obLogin['email'], 
            'password' => $obLogin['password']
        ];
        
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
   

        return ['user' =>  [ 
                            'id' => auth()->user()->id, 
                            'nome' => auth()->user()->name, 
                            'email' => auth()->user()->email,
                            'blAdmin' => auth()->user()->blAdmin
                            ] , 
                'access_token' => $this->respondWithToken($token) 
                ];
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return [ 'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL()];
    }

    

}
