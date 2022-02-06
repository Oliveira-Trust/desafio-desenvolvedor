<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RefreshTokenApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(request()->route()->uri, 'ok');
        if(auth()->user() && request()->route()->uri == 'home') {
            dd('ok');
            $newToken = Str::random(60);
            User::find(auth()->user()->id)->update(['api_token' => $newToken]);
            $request->session()->push('token_api', $newToken);
        }
// dd(auth()->user());
        return $next($request);

    }
}
