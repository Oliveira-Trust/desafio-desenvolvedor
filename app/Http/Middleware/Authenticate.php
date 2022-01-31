<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $guard = \Auth::guard()->getName();
        if (!$request->expectsJson()) {
//            dd($guard);
            return route(preg_match('#web_admin#s',$guard) ? 'admin.login' : 'customer.login');
        }
    }
}
