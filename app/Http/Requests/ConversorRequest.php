<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ConversorRequest extends FormRequest
{
    protected $redirectRoute = 'home';

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
            'moeda' => 'required',
            'valor' => 'required|gte:1000|lte:100000',
            'pagamento' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'moeda.required' => 'Você precisa selecionar uma moeda para conversão.',
            'valor.required' => 'É necessário preencher o valor da conversão.',
            'valor.gte'      => 'O valor mínimo deve ser igual ou maior que R$ 1.000,00',
            'valor.lte'      => 'O valor máximo deve ser igual ou menor que R$ 100.000,00',
            'pagamento.required' => 'É necessário informar o meio de pagamento.',
        ];
    }
}
