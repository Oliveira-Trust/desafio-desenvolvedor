<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;

class AdminChecker
{
    public function handle(Request $request, Closure $next)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::user()->isAdmin())
                return $next($request);
            }
        }

        
       return redirect(RouteServiceProvider::HOME);
    }
}
