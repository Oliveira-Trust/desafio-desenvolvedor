<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PeterPetrus\Auth\PassportToken;

class AuthApiForToken
{
    public function handle($request, Closure $next)
    {

        $headersTK = $request->header('authorization');
        $token = new PassportToken(
            $headersTK
        );

        // Check if token exists in DB (table 'oauth_access_tokens'), require \Illuminate\Support\Facades\DB class
        if ($token->valid) {
            if ($token->existsValid()) {
                Auth::login(User::find($token->user_id));
                return $next($request);
            }
        }

        return response([
            'msg-solution' => "Invalid Token, this credentials don't match!",
            'message-status' => "Unauthenticated"
        ], 403);
    }
}
