<?php

namespace App\Http\Requests\Cotacao;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cotacao\CotacaoTaxa;

class CotacaoTaxaRequest extends FormRequest
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
            'dsc_cotacao_taxa' => ['required', 'min:5', 'max:4000'],
            'tipo_cobranca_id' => ['required', 'integer', 'exists:tipos_cobrancas,id'],
            'per_cotacao_taxa' => [
                'bail',
                'required',
                'numeric',
                'between:0.01,100.00',
                function($attribute, $value, $fail){
                    $perCotacaoTaxaTotal = CotacaoTaxa::query()
                        ->whereNotNull('tipo_cobranca_id')
                        ->where('tipo_cobranca_id', $this->tipo_cobranca_id)
                        ->sum('per_cotacao_taxa');

                    if(($perCotacaoTaxaTotal + $this->per_cotacao_taxa) > 100){
                        $fail("Ultrapassou 100%");
                    }
                }
            ],
            'ind_status' => ['required', 'in:1,2']
        ];
    }
}
