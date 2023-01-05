<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class TaxaRequest extends FormRequest
{
    //Removendo a máscara do input para validação
    protected function prepareForValidation()
    {
        $this->merge([
            'valor' => Str::replace(',', '.', Str::replace('.' ,'', $this->valor)),
        ]);
    }

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'valor' => 'required|gte:1000|lte:100000',
            'taxa' => 'required|gt:0',
        ];
    }

    public function messages()
    {
        return [
            'valor.required' => 'É necessário preencher o valor da taxa.',
            'valor.gte'      => 'O valor mínimo deve ser igual ou maior que R$ 1.000,00',
            'valor.lte'      => 'O valor máximo deve ser igual ou menor que R$ 100.000,00',
            'taxa.required' => 'É necessário informar o valor da taxa.',
            'taxa.gt'      => 'O valor precisa ser maior do que 0.',
        ];
    }
}
