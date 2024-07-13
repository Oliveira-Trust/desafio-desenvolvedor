<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exceptions\AuthException;
use App\Facades\Helpers;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JWTAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     *
     * @throws \Throwable
     */
    public function handle(Request $request, Closure $next): Response
    {
        throw_unless(Helpers::authUser(), AuthException::unauthorized());

        return $next($request);
    }
}
