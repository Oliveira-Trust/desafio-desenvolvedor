<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'nome_produto' => 'required',
            'descricao_produto' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome_produto.required' => 'Nome do produto e Obrigatorio',
            'descricao_produto.required' => 'Descrição Produto e Obrigatorio',
           
        ];
    }

}
