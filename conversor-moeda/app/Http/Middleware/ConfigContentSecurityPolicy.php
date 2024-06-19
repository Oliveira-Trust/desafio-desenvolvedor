<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConfigContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $policies = config('csp.policies');
        $policyString = collect($policies)->map(function($value, $key) {
            return "$key $value";
        })->implode('; ');

        $response->headers->set('Content-Security-Policy', $policyString);

        return $response;
    }
}
