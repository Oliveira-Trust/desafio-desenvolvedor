<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    //Registrar Usuarios
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'nome'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if($validator->fails()){
            return response([
                'message'   => 'Erro de Validação',
                'errors'    => $validator->errors(),
                'status'    => false
            ]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $usuario = Usuarios::where('email', $input['email'])->first();

        if($usuario)
            return response([
                'message' => 'Email já cadastrado, Realize a recuperação da Senha',
                'status' => false
            ]);

        $usuario = Usuarios::create($input);

        $data['token'] = $usuario->createToken('TrustApp')->accessToken;
        $data['nome'] = $usuario->nome;

        return response([
            'data' => $data,
            'message' => 'Usuario Criado com Sucesso!',
            'status' => true
        ]);


    }

    public function login(Request $request){

       $validator = Validator::make($request->all(),[
           'email'=>'required|string|email',
           'password'=>'required|string'
       ]);

       if($validator->fails()){
            return response([
                'message'   => 'Erro de Validação',
                'errors'    => $validator->errors(),
                'status'    => false
            ]);
        }
       // dd(auth()->attempt($request->all()));
        $usuario = Usuarios::where('email', $request->email)->first();

        if($usuario){
            if(Hash::check($request->password, $usuario->password)){
            $token = $usuario->createToken('TrustApp')->accessToken;
            $usuario->token = $token;
                $response = [
                    'usuario' => $usuario
                ];
                return response($response, 200);
            } else {
                $response = ["message" => "Usuario ou Senha Inválidos"];
                return response($response, 422);
            }

        }else{
            $response = ["message" => "Usuario ou sehna Inválidos"];
            return response($response, 422);
        }
    }
    public function logout (Request $request) {
        $token = $request->usuario()->token();
        $token->revoke();
        $response = ['message' => 'Logout Efetuado com sucesso'];
        return response($response, 200);
    }
}
