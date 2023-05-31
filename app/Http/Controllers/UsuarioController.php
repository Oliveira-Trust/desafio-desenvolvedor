<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     *
     * Cadastra um novo usuário
     * 
     * @param string nome Exemplo: Flavia Teles 
     * @param string email Exemplo:1200
     * @param string senha Exemplo:@F345678
     *    
     * @return json informando que o Usuário foi cadastrado
     */

    public function cadastrarUsuario(Request $request)
    {
        $validacao =  Validator::make($request->all(), [
            'nome' => 'required',
            'email' => ['required', 'email'],
            'senha' => 'required|min:4'
        ]);

        if ($validacao->fails()) {
            return response()->json(['message' => $validacao->errors(), 'status' => 401], 401);
        }

        $usuario = User::create([
            'name' => $request->nome,
            'email' => $request->email,
            'password' => bcrypt($request->senha)
        ]);

        Auth::login($usuario);

        return response()->json(['message' => 'Usuário cadastrado', 'status' => 200], 200);
      
    }

     /**
     *
     * Efetuar o login de um usuário
     * 
     * @param string email Exemplo:1200
     * @param string senha Exemplo:@F345678
     *    
     * @return json Se a senha e mail estiverem corretos será redirecionado para a Conversão de valores, senão informado que  o Usuário(email) estão inválidos
     */

    public function login(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'senha' => 'required|min:4'
        ]);

        if ($validacao->fails()) {
            return response()->json(['message' => $validacao->errors(), 'status' => 401], 401);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->senha,
        ];

        if (Auth::attempt($credentials)) {
            $user = auth()->user();

           return response()->redirectTo('conversao');
        } else {
            return response()->json(['message' => "Usuário ou senha inválidos!", 'status' => 403], 403);
        }

    }


        /**
     *
     * Logout da aplicação 
     *     
     * @return response redirecionamento para o login
     */

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        
        return response()->redirectTo('login');
    }
}
