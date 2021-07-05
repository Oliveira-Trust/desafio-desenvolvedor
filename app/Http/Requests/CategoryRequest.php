<?php

namespace App\Http\Requests;

use App\Rules\LabelVerification;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        if(request()->method() == 'POST'){
            return [
                'name'                  =>      [ 'required', 'min:3', 'max:255', 'unique:categories,name'],
                'label'                 =>      [ 'required', 'min:3', 'max:255', 'unique:categories,label', new LabelVerification],
            ];
        } else if(request()->method() == 'PUT' || request()->method() == 'PATCH'){
            return [
                'name'                  =>      [ 'required', 'min:3', 'max:255', 'unique:categories,name,'.$this->categoria->id],
                'label'                 =>      [ 'required', 'min:3', 'max:255', 'unique:categories,label,'.$this->categoria->id, new LabelVerification],
            ];
        }
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
            'name.unique'   					=> 'O dado inserido no campo :attribute já existe em nossos registros.',
			
            'label.required'					=> 'O campo :attribute é obrigatório.',
			'label.min'							=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'label.max'							=> 'O campo :attribute precisa ter no máximo :max caracteres.',
            'label.unique'   					=> 'O dado inserido no campo :attribute já existe em nossos registros.',
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
            'name'                  =>      'Nome',
            'label'                  =>      'Parte da URL',
        ];
    }

}
