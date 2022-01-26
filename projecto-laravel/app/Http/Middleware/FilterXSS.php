<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FilterXSS
{
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();

        array_walk_recursive($input, function(&$input) {
            // Filtrando itens recebidos na requisição - automaticamente - evitando ataques XSS
            $input = strip_tags($input);
        });

        $request->merge($input);

        return $next($request);

    }
}
