<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Redirect;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     * @description Realiza a autenticação do usuário na plataforma
     */
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'Usuário não encontrado'
        ]);
    }

    /**
     * @return mixed
     * @description Redireciona o usuário para a página de registros
     */
    public function registroPage()
    {
        return view('registro');
    }

    /**
     * @param Request $request
     * @description Cadastra usuário na plataforma
     */
    public function registrarUsuario(Request $request)
    {

        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'confirm_password' => ['required']
        ]);

        $senhaUsuario = $request->get('password');
        $confirmacaoSenha = $request->get('confirm_password');

        if($senhaUsuario != $confirmacaoSenha) {
            return back()->withErrors([
                'Confirmação de senha diferente da senha digitada'
            ]);
        }

        $dadosUsuario = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ];

        User::create($dadosUsuario);


        return Redirect::route('login.page');
    }
}
