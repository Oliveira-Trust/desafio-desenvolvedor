<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;


class UserController extends Controller
{

    ## prepara as informações para fazer o login do usuário
    public function loginAcesso(Request $request)
    {
        $email = $request->email;
        $senha = $request->senha;
        $ret = UserService::loginAcesso($email, $senha);
        return response()->json($ret);
    }

    ## prepara as informações para fazer o cadastro do usuário
    public function loginCadastro(Request $request)
    {
        $nome = $request->nome;
        $email = $request->email;
        $senha = $request->senha;
        $ret = UserService::loginCadastro($nome, $email, $senha);
        return response()->json($ret);
    }

    ## Consulta o histórico de conversões de usuários já cadastrados
    ## Idealmente deveria haver mais uma validação de usuário existem/permitido, além do JS.
    public function consultarHistorico(Request $request)
    {
        $id = $request->id;
        $ret = UserService::consultarHistorico($id);
        return response()->json($ret);
    }


}
