<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxaConversaoRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'valorLimite'   =>'required|numeric|min:1001|max:99999',
        ];
    }

    public function messages(): array
    {
        return [
            'valorLimite.required'=>'Preencha o valor limite para a taxa de conversão',
            'valorLimite.min'=>'O valor limite deve ser maior que R$ 1.000,00',
            'valorInicial.max'=>'O valor limite deve ser menor que R$ 100.000,00',
        ];
    }
}
