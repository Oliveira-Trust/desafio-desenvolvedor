<?php

namespace Presentation\Api\V1\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse {
    public function handle(Request $request, Closure $next): Response {
        $request->headers->set('Accept', 'application/json');
        $response = $next($request);

        if (!$response->isRedirection()) {
            $response->headers->set('Content-Type', 'application/json');
        }

        return $response;
    }
}
