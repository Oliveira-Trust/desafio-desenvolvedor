<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' 		    => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'O campo nome é obrigatório.',
            'email.required'        => 'O campo email é obrigatório.',
            'email.regex'           => 'Email inválido.',
            'email.email'           => 'Email inválido.',
        ];
    }
}
