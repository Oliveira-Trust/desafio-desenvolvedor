<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\User;

class AreaUsuarioService
{
    public function __construct()
    {
    }

    public function alterarDadosCadastrais(Request $request)
    {
        $users = User::find($request->input('id'));
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->save();
    }

    public function alterarSenha(Request $request)
    {
        $users = User::find($request->input('id'));
        $users->password = bcrypt($request->input('senha_1'));
        $users->save();
    }

}