<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Response;

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
        if(collect($request->route()->middleware())->contains('api')){
            return json_encode('stop');
            // return response()->json(['error' => 'faça login na api e gere o token.'], 401);
        }
        // if (! ($request->expectsJson() || collect($request->route()->middleware())->contains('api'))) {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
