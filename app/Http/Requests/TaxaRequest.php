<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaxaRequest extends FormRequest
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
            'flTaxa' => 'required|numeric'
        ];
        if($this->isMethod('post') || $this->isMethod('put')){
            return $rules;
        }
        return [];

    }

    public function messages()
    {
        return [
            'flTaxa.required' => 'Informe uma taxa.',
            'flTaxa.numeric' => 'A Taxa deve ser somente numérica.'
        ];
    }

    public function attributes()
    {
        return [
            'flTaxa' => 'Taxa',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) : void
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
