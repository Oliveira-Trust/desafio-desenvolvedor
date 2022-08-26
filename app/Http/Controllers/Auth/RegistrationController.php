<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Filament\Notifications\Notification;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.registration');
    }
      
    public function handle(RegistrationRequest $request)
    {
        $this->create($request->all());

        Notification::make() 
            ->title("Cadastro realizado!")
            ->body("Bem vindo(a), " . auth()->user()->name)
            ->success()
            ->send();
         
        return redirect()->route('auth.login.index')->withSuccess('Registrado com sucesso!');
    }

    public function create(array $data): \Illuminate\Database\Eloquent\Model | null
    {
        return User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'password' => bcrypt($data['password'])
        ]);
    }
}
