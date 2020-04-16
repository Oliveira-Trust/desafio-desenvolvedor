<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderValidation extends FormRequest
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
            'client' => 'required|numeric',
            'product' => 'required|numeric',
            'quantity_ordered' => 'required|numeric',
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
            'client.required' => 'Especifique o cliente',
            'product.required' => 'Especifique o produto',
            'quantity_ordered.required' => 'Quantidade encomendada é obrigatória',
        ];
    }      
}
