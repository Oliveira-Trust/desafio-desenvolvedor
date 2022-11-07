<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Exception;

trait ValidatorsHelper
{
    public function validateUserRegister($input): void
    {
        $rules = [
            'name'              => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required',
            'confirm_password'  => 'required|same:password'
        ];
        $messages = [
            'required'  => 'O campo :attribute é obrigatório.',
            'email'     => 'O campo :attribute precisa ser um endereço de email válido.',
            'same'      => 'Os campos :attribute e :other precisam ser iguais.',
            'unique'    => 'O campo :attribute já existe no sistema.'
        ];

        $validator = Validator::make($input, $rules, $messages);
   
        if ($validator->fails()) {
            throw new Exception(json_encode($validator->errors()), 400);
        }
    }
}
