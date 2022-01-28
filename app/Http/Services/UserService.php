<?php

namespace App\Http\Services;

use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\UserRepository;


class UserService
{   
    protected $repository;

    public function __construct(UserRepository $objUserRepository){

        $this->repository = $objUserRepository;

    }

    public function updateOrCreate($requestDataUsuario,$id = null){
      
        $dataUsuario = $requestDataUsuario;
     
        $rules = [
            'name' => 'required|between:5,50',
            'email' => 'required|email|unique:users|between:5,50',
            'password'  => 'required|between:5,30|same:password_confirmation',
            'password_confirmation' => 'required|between:5,30|same:password'
        ]; 
        $messages = [
            'required' => 'Campo :attribute obrigatório.',
            'unique' => 'Já existe um :attribute cadastrado.',
            'between' => 'O :attribute deve ter entre :min e :max caracteres.',
            'same' => ' As senhas não conferem.',
            'email' => 'E-mail inválido.'
        ];
        $attributes = [
            'name' => 'nome',
            'email' => 'e-mail',
            'password' => 'senha',
            'password_confirmation' => 'confirmação de senha',
        ]; 

        if(!empty($id)){
            $dataUsuario['id'] = $id;
            $rules['email'] = ['required','email','between:5,50',Rule::unique('users')->ignore($id)];
            if(empty($dataUsuario['password'])){
                unset($rules['password']);
                unset($rules['password_confirmation']);
            }
        }
        

        $validator = Validator::make($dataUsuario,$rules,$messages,$attributes);
        if($validator->fails()){
            dd($validator->errors());
        }
        $dataUsuario['password'] = Hash::make($dataUsuario['password']);
        unset($dataUsuario['password_confirmation']);

        return $this->repository->updateOrCreate($dataUsuario);

    }

}
