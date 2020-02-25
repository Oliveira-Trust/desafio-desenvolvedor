<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientFormRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'cpf' => 'required|max:11',
            'phone' => 'required|max:11',
            'address' => 'required'
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
            'name.required' => 'Nome é obrigatório.',
            'cpf.required'  => 'CPF é obrigatório.',
            'cpf.max'  => 'Formato de cpf inválido.',
            'phone.required'  => 'Telefone é obrigatório.',
            'phone.max'  => 'Formato de telefone inválido.',
            'address.required'  => 'Endereço é obrigatório.',
        ];
    }
}
