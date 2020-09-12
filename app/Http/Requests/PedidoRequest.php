<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
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
            'status' => 'required',
            'cliente_id' => 'required',
            'produto_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'Status e Obrigatorio',
            'cliente_id.required' => 'Cliente e Obrigatorio',
            'produto_id.required' => 'Produto e Obrigatorio',
           
        ];
    }

  
}
