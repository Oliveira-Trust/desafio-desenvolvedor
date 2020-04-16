<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientValidation extends FormRequest
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
            'name' => 'required|max:200',
            'email' => 'required|email|unique:clients',
            'document' => 'required',
            'birth' => 'required',
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
            'name.required' => 'Nome é obrigatório',
            'name.max' => 'Nome é muito grande',
            'email.required' => 'E-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'E-mail já existe',
            'document.required' => 'Documento é obrigatório',
            'birth.required' => 'Data de nascimento é obrigatório',
        ];
    }
}
