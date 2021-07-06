<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a realizar esta requisição.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


     /**
     * Obtem as regras de validação e aplica na requisição.
     *
     * @return array
     */
    public function rules()
    {	
		switch (request()->method()) {
			case 'POST':
				return [
					'name'          =>      [ 'required', 'min:3', 'max:255'],
					'label'         =>      [ 'required', 'min:5', 'max:255', 'unique:products,label'],
					'value'         =>      [ 'required', 'min:4', 'max:255'],
					'description'   =>      [ 'required', 'min:20', 'max:5000'],
					'category_id'   =>      [ 'required'],
					'enabled'       =>      [ 'required'],
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [
					'name'          =>      [ 'required', 'min:3', 'max:255'],
					'label'         =>      [ 'required', 'min:5', 'max:255', 'unique:products,label,'.$this->produto->id],
					'value'         =>      [ 'required', 'min:4', 'max:255'],
					'description'   =>      [ 'required', 'min:20', 'max:5000'],
					'category_id'   =>      [ 'required'],
					'enabled'       =>      [ 'required'],
                ];

            default:
                return false;
                break;
            
        }
    }






    /**
     * Obtém atributos customizados para as mensagens de validação de erro.
     *
     * @return array
     */
    public function attributes()  {
        return [
            'name'              =>      'Nome',
            'label'             =>      'Parte da URL',
            'description'       =>      'Descrição',
            'category_id'       =>      'Categoria',
            'value'             =>      'Valor',
            'enabled'           =>      'Ativar produto?',
        ];
    }


    /**
	 * Obtem as mensagem de erro definidas nas regras de validação.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'name.required'						=> 'O campo :attribute é obrigatório.',
			'name.min'							=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'name.max'							=> 'O campo :attribute precisa ter no máximo :max caracteres.',
			
            'label.required'					=> 'O campo :attribute é obrigatório.',
			'label.min'							=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'label.max'							=> 'O campo :attribute precisa ter no máximo :max caracteres.',
            'label.unique'   					=> 'O e-mail utilizado no campo :attribute já existe em nossos registros.',

			'description.required'				=> 'O campo :attribute é obrigatório.',
			'description.min'					=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'description.max'					=> 'O campo :attribute precisa ter no máximo :max caracteres.',

			'category_id.required'				=> 'O campo :attribute é obrigatório.',
			
            'enabled.required'				    => 'O campo :attribute é obrigatório.',
			
            'value.required'				    => 'O campo :attribute é obrigatório.',
			'value.min'					        => 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'value.max'					        => 'O campo :attribute precisa ter no máximo :max caracteres.',


        ];
    }
}
