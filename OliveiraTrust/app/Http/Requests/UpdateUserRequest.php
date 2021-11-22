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
            'name.required'         => 'O campo nome � obrigat�rio.',
            'email.required'        => 'O campo email � obrigat�rio.',
            'email.regex'           => 'Email inv�lido.',
            'email.email'           => 'Email inv�lido.',
        ];
    }
}
