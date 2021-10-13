<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\NewAccountRequest;
use App\Http\Requests\RecoverEmailRequest;
use App\Jobs\NewPasswordCreatedJob;
use App\Jobs\UserCreatedJob;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return view('login.login');
    }

    public function newAccount()
    {
        return view('login.createaccount');
    }

    public function verifyLogin(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))   {
            return redirect()->route('index');
        }

        return back()->withErrors(['erro' => 'Dados incorretos. Tente novamente.']);
    }

    public function storeUser(NewAccountRequest $request)
    {
        $user = $this->userService->storeNewUser($request->validated());

        if ($user) {
            $data = [
                'user_name' => $user->name,
                'user_email' => $user->email
            ];

            //Send new user to Email Microservice throw RabbitMQ
            UserCreatedJob::dispatch($data)->onQueue('queue_email');

            return redirect()->route('login')->with('message', 'Seja bem-vindo! Faça seu login.');
        }

        return redirect()->route('login')->with('message', 'Erro ao cadastrar! Por favor, tente novamente.');
    }

    public function recoverPassword(){
        return view('login.recoverpassword');
    }

    public function newPassword(RecoverEmailRequest $request)
    {
        $email = $request->get('email');
        try {
            $data = $this->userService->setNewPassword($email);

            //Send new user to Email Microservice throw RabbitMQ
            NewPasswordCreatedJob::dispatch($data)->onQueue('queue_email');

            return redirect()->route('login')->with('message', 'Sua nova senha foi enviada para o email informado.');
        } catch (\Exception $e) {
            return redirect()->route('recover.password')->with('message', $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
