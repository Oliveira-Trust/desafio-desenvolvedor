<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        $rules = [
            'client_id'  =>      [ 'required'],
            'cart'       =>      [ 'required', 'array'],
            'status'     =>      [ 'required', 'min:4', 'max:20', 'string'],
            'paid_at'    =>      [ 'required_if:status,PAGO', 'max:10'],
        ];

        if (request()->input('status') == 'PAGO') {
            $rules['paid_at'][] = 'min:10';
            $rules['paid_at'][] = 'date_format:Y-m-d';
        }

        return $rules;
    }


    /**
	 * Obtem as mensagem de erro definidas nas regras de validação.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [							
			'client_id.required'				    => 'O campo :attribute é obrigatório.',
			
            'cart.required'		    				=> 'O campo :attribute é obrigatório.',
            'cart.array'		    				=> 'Ocorreu um problema com os itens do carrinho. Atualize a página e tente novamente!',
			
            'status.required'					    => 'O campo :attribute é obrigatório.',
            'status.min'							=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'status.max'							=> 'O campo :attribute precisa ter no máximo :max caracteres.',
			'status.string'							=> 'O campo :attribute contém informações incorretas',
			
            'paid_at.required'					    => 'O campo :attribute é obrigatório.',
            'paid_at.min'							=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'paid_at.max'							=> 'O campo :attribute precisa ter no máximo :max caracteres.',
			'paid_at.date_format'					=> 'O campo :attribute precisa ter uma data no formato DD/MM/AAAA',
        ];
    }

    
    /**
	 * Obtém atributos customizados para as mensagens de validação de erro.
	 *
	 * @return array
	 */
	public function attributes()
	{
		return [
            'client_id'           =>      'Cliente',
            'cart'                =>      'Carrinho',
            'status'              =>      'Status do Pedido',
            'paid_at'             =>      'Pago em',

		];
	}
}
