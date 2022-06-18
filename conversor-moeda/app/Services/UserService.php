<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserService
{

    ## São feitas as validações de credenciais e se tudo ok, então retorna o id do usuário
    ## Idealmente o controle de sessão deve ser feito no backend por diversas questoes mas como a ideia geral era uma visão simples, então a sessão ficou para o front    
    public static function loginAcesso($email, $senha)
    {
        $ret = new \stdClass;
        $ret->error = true;
        $email = mb_strtoupper($email, 'UTF-8');

        $select = DB::table('usuarios')->where('email', $email)->first();

        if (!$select) {
            $ret->msg = 'Usuário e/ou senha incorretos!111';
            return $ret;
        }

        if (Hash::check($senha, $select->senha)) {
            $hist = DB::table('historico_conversoes')->where('user_id', $select->id)->get();
            $ret->msg =  [
                'id'      => $select->id,
                'nome' => $select->nome,
                'historico' => $hist
            ];
            $ret->error = false;
        } else {
            $ret->msg = 'Usuário e/ou senha incorretos!333';
        }
        return $ret;
    }

    ## Cadastro de usuários
    ## Idealmente seriam necessários diversas validações (segurança, tipo de senha, tipo de entrada de variáveis); 
    public static function loginCadastro($nome, $email, $senha)
    {
        try {
            $ret = new \stdClass;
            $ret->error = true;
            $nome = mb_strtoupper($nome, 'UTF-8');
            $email = mb_strtoupper($email, 'UTF-8');
            $senha = Hash::make($senha);

            DB::beginTransaction();
            
            $exists = DB::table('usuarios')->where('email', $email)->exists();
            if ($exists) {
                $ret->msg = "Endereço de email já cadastrado";
                return $ret;
            }

            $id = DB::table('usuarios')->insertGetId([
                'nome' => $nome,
                'email' => $email,
                'senha' => $senha,
                'created_at' => Carbon::now()
            ]);
            $ret->msg = $id;
            DB::commit();
            $ret->error = false;
            return $ret;
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    ## Consulta o historico de conversões no banco de dados
    public static function consultarHistorico($id)
    {
        $ret = new \stdClass;
        $ret->error = false;
        $hist = DB::table('historico_conversoes')->where('user_id', $id)->get();
        $ret->msg = $hist;
        return $ret;
    }
}
