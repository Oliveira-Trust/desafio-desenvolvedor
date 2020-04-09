<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidation extends FormRequest
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
            'name' => 'required|max:100',
            'email' => 'required|email|max:255',
            'password' => 'required|min:4'
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
             'name.required'  => 'O campo nome é obrigatório',
             'name.max'  => 'O campo nome ultrapassou 100 caracteres',
             'email.required'  => 'O descrição é obrigatório',
             'email.email'  => 'Esse email é inválido',
             'email.max'  => 'O email ultrapassou 255 caracteres',
             'password.required'  => 'A senha é obrigatória',
             'password.min'  => 'A senha deve ter no mínimo 4 caracteres',
         ];
     }
}
