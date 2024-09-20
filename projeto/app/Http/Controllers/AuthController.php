<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth/login');
    }

    public function auth(AuthRequest $request): RedirectResponse
    {
        $credenciais = $request->only('email', 'password');

        if (Auth::attempt($credenciais)) {
            return redirect()->intended();
        }

        return redirect()->route('login')->with('error', 'E-mail e ou senha errados.');
    }

    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
        return Redirect::route('login')->with('success', 'Sessão encerrada com sucesso.');
    }
}
