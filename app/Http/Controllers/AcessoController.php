<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcessoRequest;
use Illuminate\Support\Facades\Auth;

class AcessoController extends Controller
{
    public function acessar(AcessoRequest $request)
    {
        if ($request->isMethod('POST')) {
            if (Auth::attempt($request->validated())) {
                $request->session()->regenerate();
                return redirect()->intended(route('principal'));
            }
            return back()->withErrors([
                'errors' => 'Suas credenciais estão com erro',
            ]);
        }
    }
}
