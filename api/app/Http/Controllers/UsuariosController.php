<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios;
use Validator;

class UsuariosController extends Controller {

    //Registrar Usuarios
    public function create(Request $request){
        $input = $request->all();
        $usuario = Usuarios::where('email', $input['email'])->first();

        if($usuario)
            return response([
                'message' => 'Email já cadastrado, Realize a recuperação da Senha',
                'status' => false
            ]);

        $usuario = Usuarios::create($input);

        return response([
            'usuario' => $usuario,
            'message' => 'Usuario Criado com Sucesso!',
            'status' => true
        ]);


    }
    public function show($id = null){
        if($id==null){
            $usuarios = Usuarios::all();
            return response([
                'usuarios' => $usuarios,
                'rows'=>$usuarios->count(),
                'message' => 'Usuarios encontradas com Sucesso!',
                'status' => true
            ]);
        }else{
            $usuarios = Usuarios::find($id);
            return response([
                'usuarios' => $usuarios,
                'message' => 'Usuarios encontrada com Sucesso!',
                'status' => true
            ]);
        }
    }

    public function update($id, Request $request){

        $usuarios = Usuarios::find($id);

        $usuarios->nome = ($request->nome==$usuarios->nome) ? $usuarios->nome:$request->nome;

        $usuarios->email = ($request->email==$usuarios->email) ? $usuarios->email:$request->email;

        $usuarios->admin = ($request->admin==$usuarios->admin) ? $usuarios->admin:$request->admin;

        $usuarios->password = ($request->password==$usuarios->password) ? $usuarios->password:$request->password;

        $usuarios->ativo = ($request->ativo==$usuarios->ativo) ? $usuarios->ativo:$request->ativo;

        $usuarios->save();

        return response([
            'usuarios'=>$usuarios,
            'message' => 'Usuário atualizado com Sucesso',
            'status' => true
        ]);
    }

    public function delete($id){

        $usuarios = Usuarios::find($id);

        $usuarios->delete();

        return response([
            'message' => 'Usuário removido com Sucesso',
            'status' => true
        ]);
    }
}
