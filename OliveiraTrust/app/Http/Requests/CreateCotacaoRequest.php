<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCotacaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'moeda_origem'          => 'required',
            'moeda_destino'         => 'required',
            'taxa_conversao'        => 'required',
            'taxa_forma_pagamento'  => 'required',
            'valor_liquido '        => 'required',
            'valor_bruto '          => 'required',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
