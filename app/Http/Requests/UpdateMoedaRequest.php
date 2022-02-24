<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMoedaRequest extends FormRequest
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
            'nome' => 'required|string',
            'sigla' => 'required|unique:moedas,sigla,' . $this->id
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => 'O campo Nome é obrigatorio.',
            'sigla.required' => 'O campo Sigla é obrigatório.',
            'sigla.unique' => 'A Sigla atual já pertence a outro cadastro.'
        ];
    }
}
