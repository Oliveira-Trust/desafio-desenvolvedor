<?php

namespace App\Http\Requests\Cotacao;

use Illuminate\Foundation\Http\FormRequest;

class CotacaoTaxaRangeRequest extends FormRequest
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
        $id = request()->route()->parameter('cotacao_taxa_range');
        /*$tipoCobranca = CotacaoTaxa::where('id', $id)
            ->select(['tipo_cobranca_id'])
            ->first();*/

        return [
            //'cotacao_taxa_id' => ['required', 'exists:cotacoes_taxas,id'],
            'val_minimo' => [
                'nullable',
                'numeric',
                'between:0.01,9999999999999.99',
                //'required_if:val_maximo,=,null',
                /*function($attribute, $value, $fail) use ($tipoCobranca){
                     if(
                        (!is_null($this->val_maximo) && is_null($value)) || 
                        (is_null($this->val_maximo) && !is_null($value))
                    ){
                        if(!is_null($tipoCobranca)){
                            $cotacaoTaxaModel = CotacaoTaxa::from('cotacoes_taxas as a')
                                ->join('cotacoes_taxas_ranges as b', 'b.cotacao_taxa_id', 'a.id')
                                ->where('a.tipo_cobranca_id', $tipoCobranca->tipo_cobranca_id)
                                ->whereNull('b.val_maximo')
                                ->count();

                            if($cotacaoTaxaModel > 0){
                                $fail("Valor Mínimo já cadastrado");
                            }  
                        }
                    }
                }*/
            ],
            'val_maximo' => [
                'nullable',
                'numeric',
                'between:0.01,9999999999999.99',
                'required_if:val_minimo,=,null',
                //'gt:val_minimo',
                /*function($attribute, $value, $fail) use ($tipoCobranca){
                    if(
                        (!is_null($this->val_minimo) && is_null($value)) || 
                        (is_null($this->val_minimo) && !is_null($value))
                    ){
                        if(!is_null($tipoCobranca)){
                            $cotacaoTaxaModel = CotacaoTaxa::from('cotacoes_taxas as a')
                                ->join('cotacoes_taxas_ranges as b', 'b.cotacao_taxa_id', 'a.id')
                                ->where('a.tipo_cobranca_id', $tipoCobranca->tipo_cobranca_id)
                                ->whereNull('b.val_minimo')
                                ->count();

                            if($cotacaoTaxaModel > 0){
                                $fail("Valor Máximo já cadastrado");
                            } 
                        }
                    }
                }*/
            ],
            'ind_status' => ['required', 'in:1,2']
        ];
    }
}
