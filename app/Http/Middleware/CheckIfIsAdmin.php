<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // se o usuário tentar acessar o painel e estiver logado, barra a requisição
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        // se o usuário tentar acessar o painel e não for admin, barra a requisição
        //        if (! auth()->user()->isAdministrator()) {
        //            return redirect()->route('site.index');
        //        }

        return $next($request);
    }
}
