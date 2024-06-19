<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'boleto' => 'required|numeric',
            'cartao_credito' => 'required|numeric',
            'conversao_maior_3000' => 'required|numeric',
            'conversao_menor_3000' => 'required|numeric',
        ];
    }
}
