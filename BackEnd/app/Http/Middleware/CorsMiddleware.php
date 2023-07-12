<?php

namespace App\Http\Middleware;

use PhpParser\Node\Stmt\Return_;



class CorsMiddleware
{
    public function handle($request, \Closure $next)
    {
        if ($request->isMethod('OPTIONS')) {
            $response = response('', 200);
        } else {
            $response = $next($request);
        }
        $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
        $response->header('Access-Control-Allow-Headers', $request->Header('Acess-Controll-Request-Headers'));
        $response->header('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
