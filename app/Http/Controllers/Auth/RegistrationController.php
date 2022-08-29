<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class RegistrationController extends Controller
{
    public function index(): View
    {
        return view('auth.registration');
    }
      
    public function handle(RegistrationRequest $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $credentials = [
            ...$request->only('name', 'email'),
            'password' => bcrypt($request->password)
        ];

        $user = User::create($credentials);
        
        Notification::make() 
            ->title("Cadastro realizado!")
            ->body("Bem vindo(a), " . $user->name)
            ->success()
            ->send();
         
        return redirect()->route('auth.login.index');
    }
}
