<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Session;

class CustomAuthController extends Controller
{

  public function index()
  {
    if(!Auth::guest()){
      return redirect()->route('dashboard');
    }
    return view('auth.login');
  }

  public function customLogin(Request $request)
  {
    $request->validate([
      'email' => 'required',
      'password' => 'required',
    ]);
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect()->intended('dashboard');
    }
    return redirect("login")->with('error', 'Login ou senha incorretos!');
  }

  public function signOut()
  {
    Session::flush();
    Auth::logout();

    return Redirect('login');
  }
}