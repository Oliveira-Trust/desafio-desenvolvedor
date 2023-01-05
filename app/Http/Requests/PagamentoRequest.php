<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagamentoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'nome' => 'required',
            'taxa' => 'required|gt:0',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Você precisa informar um nome para a forma de pagamento.',
            'taxa.required' => 'É necessário informar o valor da taxa.',
            'taxa.gt'      => 'O valor precisa ser maior do que 0.',
        ];
    }
}
