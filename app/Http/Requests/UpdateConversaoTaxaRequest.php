<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConversaoTaxaRequest extends FormRequest
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
            'valor' => 'required|numeric',
            'taxa'  => 'required|numeric|min:0',
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
            'taxa.required'     => 'O valor é obrigatório',
            'taxa.numeric'      => 'O valor deve estar no formato numérico',
            'taxa.min'          => 'Taxa inválida',
        ];
    }
}
