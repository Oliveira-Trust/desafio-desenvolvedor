<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest as Request;

class LoginController extends Controller
{
    /**
     * @return Illuminate\Support\Facades\View
     */
    public function login()
    {
        return view('auth.login'); 
    }

    /**
     * @param Request
     * @return Illuminate\Support\Facades\Redirect
     */
    public function authenticate(Request $request)
    {
        if (! \Auth::attempt($request->except('_token'), $request->remember ?? false))
            return back()->with('status', 'Login ou senha inválido');

        return redirect('/dashboard');
    }
    
    public function logout()
    {
        if (\Auth::logout())
            return route('login');

        return back();
    }
}
