<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UsuarioController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(request $request)
    {
                    

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser(request $request)
    {
        if(!empty($request->nome)){
            $nome = $request->nome;
        }else{
            $nome = "";
        }

        if(!empty($request->email)){
            $email = $request->email;
        }else{
            $email = "";
        }

        if(!empty($request->senha)){
            $senha = $request->senha;
        }else{
            $senha = "";
        }

        DB::table('users_ot')->insert(
            [
                'nome' => $nome,
                'email' => $email,
                'senha' => $senha,          
            ]
        );
    }
    
}
