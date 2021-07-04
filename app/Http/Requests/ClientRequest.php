<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Rules\CpfValidation;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
					'name'                  =>      [ 'required', 'min:3', 'max:255'],
					'email'                 =>      [ 'required', 'min:5', 'max:255', 'email', 'unique:users,email'],
					'password'              =>      [ 'required', 'min:8', 'max:255'],
					'enable'                =>      [ 'required', 'boolean'],
		
					'address_zipcode'       =>      [ 'required', 'min:8', 'max:10'],
					'address_street'        =>      [ 'required', 'min:1', 'max:255'],
					'address_number'        =>      [ 'required', 'integer'],
					'address_complement'    =>      [ 'nullable', 'max:255'],
					'address_neighborhood'  =>      [ 'required', 'min:1', 'max:255'],
					'city_id'               =>      [ 'required', 'integer'],
					
					'phone_number'          =>      [ 'required', 'min:12', 'max:15'],
					'phone_number2'         =>      [ 'nullable', 'max:15'],
					'document'              =>      [ 'required', 'min:12', 'max:15', 'unique:clients,document' , new CpfValidation],
					'birth'                 =>      [ 'required', 'min:10', 'max:10', 'date_format:d/m/Y'],
				];
				break;

			case 'PUT':
			case 'PATCH':
				return [
					'name'                  =>      [ 'required', 'min:3', 'max:255'],
					'email'                 =>      [ 'required', 'min:5', 'max:255', 'email', 'unique:users,email,'.$this->cliente->user->id],
					'password'              =>      [ 'required', 'min:8', 'max:255'],
					'enable'                =>      [ 'required', 'boolean'],
		
					'address_zipcode'       =>      [ 'required', 'min:8', 'max:10'],
					'address_street'        =>      [ 'required', 'min:1', 'max:255'],
					'address_number'        =>      [ 'required', 'integer'],
					'address_complement'    =>      [ 'nullable', 'max:255'],
					'address_neighborhood'  =>      [ 'required', 'min:1', 'max:255'],
					'city_id'               =>      [ 'required', 'integer'],
					
					'phone_number'          =>      [ 'required', 'min:12', 'max:15'],
					'phone_number2'         =>      [ 'nullable', 'max:15'],
					'document'              =>      [ 'required', 'min:12', 'max:15', 'unique:clients,document,'.$this->cliente->id , new CpfValidation],
					'birth'                 =>      [ 'required', 'min:10', 'max:10', 'date_format:d/m/Y'],
				];
				break;

			default:
				return false;
				break;
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
			
            'email.required'					=> 'O campo :attribute é obrigatório.',
			'email.min'							=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'email.max'							=> 'O campo :attribute precisa ter no máximo :max caracteres.',
            'email.email'   					=> 'O campo :attribute não possui um e-mail válido.',
            'email.unique'   					=> 'O e-mail utilizado no campo :attribute já existe em nossos registros.',

			'password.required'					=> 'O campo :attribute é obrigatório.',
			'password.min'						=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'password.max'						=> 'O campo :attribute precisa ter no máximo :max caracteres.',
            
			'enable.required'					=> 'O campo :attribute é obrigatório.',
			'enable.boolean'					=> 'O campo :attribute contém informações incorretas.',

			'address_zipcode.required'			=> 'O campo :attribute é obrigatório.',
			'address_zipcode.min'				=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'address_zipcode.max'				=> 'O campo :attribute precisa ter no máximo :max caracteres.',
            
			'address_street.required'			=> 'O campo :attribute é obrigatório.',
			'address_street.min'				=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'address_street.max'				=> 'O campo :attribute precisa ter no máximo :max caracteres.',
            
			'address_number.required'			=> 'O campo :attribute é obrigatório.',
			'address_number.integer'			=> 'O campo :attribute aceita apenas números.',
			
            'address_complement.max'			=> 'O campo :attribute precisa ter no máximo :max caracteres.',
            
			'address_neighborhood.required' 	=> 'O campo :attribute é obrigatório.',
			'address_neighborhood.min'			=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'address_neighborhood.max'			=> 'O campo :attribute precisa ter no máximo :max caracteres.',
                        
			'city_id.required'		        	=> 'O campo :attribute é obrigatório.',
			'city_id.min'			        	=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'city_id.max'			        	=> 'O campo :attribute precisa ter no máximo :max caracteres.',
            
			'phone_number.required'		    	=> 'O campo :attribute é obrigatório.',
			'phone_number.min'			    	=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'phone_number.max'			    	=> 'O campo :attribute precisa ter no máximo :max caracteres.',
            
			'phone_number2.max'				    => 'O campo :attribute precisa ter no máximo :max caracteres.',
            
			'document.required'			        => 'O campo :attribute é obrigatório.',
			'document.min'				        => 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'document.max'				        => 'O campo :attribute precisa ter no máximo :max caracteres.',
            'document.unique'   				=> 'O documento utilizado no campo :attribute já existe em nossos registros.',
            
			'birth.required'		           	=> 'O campo :attribute é obrigatório.',
			'birth.min'			         	    => 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'birth.max'				            => 'O campo :attribute precisa ter no máximo :max caracteres.',
			'birth.date_format'				    => 'A data informada no campo :attribute tem um formato inválido (aceito apenas DD/MM/YYYY).',

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
            'email'                 =>      'E-mail',
            'password'              =>      'Senha',
            'enable'                =>      'Ativar usuário?',

            'address_zipcode'       =>      'CEP',
            'address_street'        =>      'Rua',
            'address_number'        =>      'Número',
            'address_complement'    =>      'Complemento do Endereço',
            'address_neighborhood'  =>      'Bairro',
            'state_id'              =>      'Estado',
            'city_id'               =>      'Cidade',
            
            'phone_number'          =>      'Telefone',
            'phone_number2'         =>      'Telefone 2',
            'document'              =>      'CPF',
            'birth'                 =>      'Data de Nascimento',
		];
	}


}
