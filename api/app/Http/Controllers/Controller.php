<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    //Add this method to the Controller class
    protected function respondWithToken($user, $token)
    {
        return response()->json([
            'email' => $user->email,
            'name' => $user->name,
            'jwt' => [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60
            ]
        ], 200);
    }
}
