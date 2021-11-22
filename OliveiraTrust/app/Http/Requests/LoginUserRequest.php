<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'email' 	    => 'email|required|regex:/^[\S]+$/',
            'password' 		=> 'required|min:2|max:10',
        ];
    }

    public function messages()
    {
        return [
            'email.required'        => 'O campo email é obrigatório.',
            'email.regex'           => 'Email inválido.',
            'email.unique'          => 'Email inválido.',
            'email.email'           => 'Email inválido.',
            'password.min'          => 'O campo senha deve ter no mínimo 4 caracteres.',
            'password.max'          => 'O campo senha deve ter no máximo 10 caracteres.'
        ];
    }
}
