<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
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
            'cpf' => 'required|cpf|unique:users|max:11',
            'email' => 'required|email|unique:users|max:180',
            'password' => 'required|min:8',
            'admin' => 'required',
        ];
    }
}
