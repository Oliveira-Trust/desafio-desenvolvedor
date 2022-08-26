<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function handle(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            Notification::make() 
            ->title("Bem vindo(a)!")
            ->body("Logado como " . auth()->user()->name)
            ->success()
            ->send();

            return redirect()
                    ->intended('dashboard');
        }

        Notification::make() 
            ->title("Email ou senha inválidos.")
            ->danger()
            ->send();

        return redirect()
                ->route('auth.login.index')
                ->withErrors(['error' => 'Email ou senha inválidos.']);
    }

    public function logout() {
        session()->flush();
        Auth::logout();

        Notification::make()
            ->success()
            ->title("Sessão encerrada.")
            ->send();
  
        return redirect()->route('auth.login.index');
    }
}
