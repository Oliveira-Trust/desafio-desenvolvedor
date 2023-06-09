<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    
    public function handle($request, Closure $next, ...$guards)
    {
        // if (Auth::check()) {
        //     $user = $request->user(); // Acessa o objeto User autenticado
        //     $user_id = $user->id; // Acessa o ID do usuário autenticado
        //     $user_email = $user->email; // Acessa o email do usuário autenticado
        //     // Realize outras operações com os dados do usuário autenticado
        // }

        // dd($user);
        // dd($request->all());
        // if (Auth::check()) {
        //     $user = $request->user(); // Acessa o objeto User autenticado
        //     $user_id = $user->id; // Acessa o ID do usuário autenticado
        //     $user_email = $user->email; // Acessa o email do usuário autenticado
        //     // Realize outras operações com os dados do usuário autenticado
        // }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
