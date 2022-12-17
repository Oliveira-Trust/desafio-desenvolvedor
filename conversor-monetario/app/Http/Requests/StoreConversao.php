<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConversao extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'base' => 'required',
            'destino' => 'required',
            'valor' => 'required|numeric|between:1001,99999',
            'pagamento' => 'required',
        ];
    }

    public function messages(){
        return [
            'base.required' => 'O campo de moeda base não pode estar vazio!',
            'destino.required' => 'O campo de moeda de destino não pode estar vazio!',
            
            'valor.required' => 'O campo de valor não pode estar vazio!',
            'valor.between' => 'O valor deve estar entre R$ 1.000,00 e R$ 100.000,00',
            
            
            'pagamento.required' => 'O campo de pagameto não pode estar vazio!',
        ];
    }
}
