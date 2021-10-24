<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\Moeda\MoedaService;

class UserCotacaoRequest extends FormRequest
{

    private $REGRA = [
        'BRL' => [
            'val_inicial' => 1000,
            'val_final' => 100000
        ],
        'USD' => [
            'val_inicial' => 1000,
            'val_final' => 100000
        ]
    ];

    public function __construct(
        MoedaService $moedaService
    ){
        $this->moedaService = $moedaService;
    }

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
        $combinacoesMoedas = $this->moedaService->getCombinacoesMoedas();
        $moedas = $this->moedaService->getMoedas();

        return [
            //'user_id' => ['required', 'integer', 'exists:users,id'],
            'tipo_cobranca_id' => ['required', 'integer', 'exists:tipos_cobrancas,id'],
            'moeda_origem_id' => [
                'required',
                'string',
                function($attribute, $value, $fail) use ($combinacoesMoedas){
                    $moedaCombinacao = "{$value}-{$this->moeda_destino_id}";
                    if($combinacoesMoedas->get($moedaCombinacao) == null){
                        $fail("Combinação de Moedas não encontrada pela API ({$moedaCombinacao})");
                    }
                },
                function($attribute, $value, $fail) use ($moedas){
                    try {
                        if(!$moedas->has($value)){
                            $fail('Moeda Inexistente');
                        }
                    } catch(\Exception $e){
                        $fail($e->getMessage());
                    }
                },
                //'exists:moedas,moeda_id'
            ],
            'moeda_destino_id' => [
                'required',
                'string',
                function($attribute, $value, $fail) use ($combinacoesMoedas){
                    $moedaCombinacao = "{$this->moeda_origem_id}-{$value}";
                    if($combinacoesMoedas->get($moedaCombinacao) == null){
                        $fail("Combinação de Moedas não encontrada pela API ({$moedaCombinacao})");
                    }
                },
                function($attribute, $value, $fail) use ($moedas){
                    try {
                        if(!$moedas->has($value)){
                            $fail('Moeda Inexistente');
                        }
                    } catch(\Exception $e){
                        $fail($e->getMessage());
                    }
                }
            ],
            'val_quantia' => [
                'required', 
                'numeric',
                'between:0.01,9999999999999.99',
                isset($this->REGRA[$this->moeda_origem_id])
                    ? 'between:' . $this->REGRA[$this->moeda_origem_id]['val_inicial'] . "," . $this->REGRA[$this->moeda_origem_id]['val_final']
                    : 'between:' . '1000,100000',
                //'exists:moedas,moeda_id'
            ],
        ];
    }

    public function messages(){
        return [
        ];
    }

    public function attributes()
    {
        return [
        ];
    }
}
