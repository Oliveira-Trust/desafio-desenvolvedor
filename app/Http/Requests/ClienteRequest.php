<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'nome' => 'required',
            'cpf' => 'required',
            'data_nascimento' => 'required|date_format:d/m/Y'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome Obrigatorio',
            'data_nascimento.required' => 'Data Nascimento Obrigatorio',
            'data_nascimento.date_format' => 'Data Nascimento inválida',
            'cpf.required' => 'Cpf Obrigatorio',
            'cpf.cpf' => 'Cpf Invalido',

        ];
    }
}
