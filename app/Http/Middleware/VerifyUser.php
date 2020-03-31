<?php

namespace App\Http\Middleware;

use Closure;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userSession = $request->session()->get('userData');

        if ( !is_null($userSession) ) {
            return $next($request);
        }

        return redirect()->route('auth.index');

    }
}
