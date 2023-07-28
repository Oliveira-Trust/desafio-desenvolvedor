
<?php
// app/Middleware/AuthMiddleware.php

namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Auth\AuthenticationException;

class AuthMiddleware
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function handle(Request $request, Closure $next)
    {
        if (!$this->authService->user()) {
            throw new AuthenticationException;
        }

        return $next($request);
    }
}
