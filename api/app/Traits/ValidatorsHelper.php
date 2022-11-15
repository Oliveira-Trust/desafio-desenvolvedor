<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Exception;

trait ValidatorsHelper
{

    private array $messages = [
        'required'  => 'O campo :attribute é obrigatório.',
        'email'     => 'O campo :attribute precisa ser um endereço de email válido.',
        'same'      => 'Os campos :attribute e :other precisam ser iguais.',
        'unique'    => 'O campo :attribute já existe no sistema.',
        'numeric'   => 'O campo :attribute precisa ser um número.',
        'min'       => 'O campo :attribute precisa ter ao menos :min caracteres.'
    ];

    public function validateUserRegister($input): void
    {
        $rules = [
            'name'              => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|min:8',
            'confirm_password'  => 'required|same:password'
        ];

        $validator = Validator::make($input, $rules, $this->messages);
   
        if ($validator->fails()) {
            throw new Exception(json_encode($validator->errors()), 400);
        }
    }

    public function validateExchangeSimulation($input): void
    {
        $rules = [
            'value'         => 'required|numeric',
            'currency_from' => 'required',
            'currency_to'   => 'required',
            'method'        => 'required'
        ];

        $validator = Validator::make($input, $rules, $this->messages);
   
        if ($validator->fails()) {
            throw new Exception(json_encode($validator->errors()), 400);
        }
    }
}
