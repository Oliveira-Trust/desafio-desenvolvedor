<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidation extends FormRequest
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
            'price' => 'required|numeric',
            'available_quantity' => 'required|numeric',
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
            'price.required' => 'Preço é obrigatório',
            'price.numeric' => 'Preço inválido',
            'available_quantity.required' => 'A quantidade disponível é obrigatória',
        ];
    }  
}
