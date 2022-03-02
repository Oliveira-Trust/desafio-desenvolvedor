<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveConversaoRequest extends FormRequest
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
            'valor' => 'required|numeric|min:1000|max:100000',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'valor.required'    => 'O valor é obrigatório',
            'valor.numeric'     => 'O valor deve estar no formato numérico',
            'valor.min'         => 'O valor de compra deve ser maior que R$ 1.000',
            'valor.max'         => 'O valor de compra deve ser menor que R$ 100.000,00',
        ];
    }
}
