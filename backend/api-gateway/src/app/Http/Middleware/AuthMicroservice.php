<?php

namespace App\Http\Middleware;

use App\Services\ApiConsume\User\UserApiService;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthMicroservice {

    public function __construct(private UserApiService $auth_api_service) {

    }

    private function getAuthorization(Request $request){
        return $request->header('Authorization') ?? $request->input('Authorization');
    }

    public function handle(Request $request, Closure $next) {

        if (!$this->getAuthorization($request)) {
            throw new AuthenticationException('Unauthenticated.');
        }

        $user = $this->auth_api_service->getUserData();

        if(!$user){
            throw new AuthenticationException('Unauthenticated.');
        }

        $request->setUserResolver(function() use ($user) {
            return $user;
        });

        return $next($request);
    }
}
