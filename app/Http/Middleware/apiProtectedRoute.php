<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class apiProtectedRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $exception) {
            
            if($exception instanceof TokenInvalidException){
                return retorno(null, 401, 'Token inválido!', $exception->getMessage());
            }
            
            if($exception instanceof TokenExpiredException){
                return retorno(null, 401, 'Token expirado!', $exception->getMessage());
            }
            
            if($exception instanceof TokenBlacklistedException ){
                return retorno(null, 401, 'Token inválido!', $exception->getMessage());
            }

            if($exception instanceof JWTException){
                return retorno(null, 401, 'Token inválido!', $exception->getMessage());
            }

            return retorno(null, 401, 'Faça login na API e gere um Token!', $exception->getMessage());
        }

        return $next($request);
    }
}