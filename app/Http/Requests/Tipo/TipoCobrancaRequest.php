<?php

namespace App\Http\Requests\Tipo;

use Illuminate\Foundation\Http\FormRequest;

class TipoCobrancaRequest extends FormRequest
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
            'nom_tipo_cobranca' => ['required', 'unique:tipos_cobrancas,nom_tipo_cobranca', 'string', 'min:3', 'max:4000'],
            'ind_status' => ['required', 'in:1,2']
        ];
    }
}
