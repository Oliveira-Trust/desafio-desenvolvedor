<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConverterValorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Defina a lógica de autorização, se necessário
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'moeda_origem' => 'required|string',
            'moeda_destino' => 'required|string',
            'valor' => 'required|numeric|min:1000|max:100000',
            'forma_pagamento' => 'required|string',
        ];
    }
}
