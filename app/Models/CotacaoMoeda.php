<?php

namespace App\Models;

use App\Jobs\EmailCotacaoMoedaJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CotacaoMoeda extends Model
{
    protected $fillable = [
        'valor_conversao', 'forma_pagamento', 'moeda_origem', 'moeda_destino', 'valor_moeda_destino',
        'valor_taxa_pagamento', 'valor_taxa_conversao', 'valor_convertido', 'user_id'
    ];

    //Função ira criar um novo registro na tabela cotacao_moedas 
    //O retorno será o objeto criado
    public function cadastrarCotacaoMoedaPorUsuario($params)
    {
        $cotacaoMoeda = CotacaoMoeda::create([
            'valor_conversao' => $params['valorConversao'],
            'forma_pagamento' => $params['tipoFormaPagamento'],
            'moeda_origem' => $params['moedaOrigem'],
            'moeda_destino' => $params['moedaDestino'],
            'valor_moeda_destino' => $params['valorMoedaDestino'],
            'valor_taxa_pagamento' => $params['valorTaxaPagamento'],
            'valor_taxa_conversao' => $params['valorTaxaConversao'],
            'valor_convertido' => $params['valorConvertido'],
            'user_id' => $params['user_id']
        ]);

        return $cotacaoMoeda;
    }


    //Função que irá consumir o serviço da awesomeapi para realizar a cotação de acordo com as moedas de origem e destino
    public function cotacaoMoedaDestino($moedaDestino)
    {
        try {
            $response = Http::get("https://economia.awesomeapi.com.br/json/last/BRL-" . $moedaDestino);

            $resultadoCotacaoMoeda = json_decode($response->getBody(), true);
            $moedaConversao = 'BRL' . $moedaDestino;
            $resultadoCotacaoMoeda = $resultadoCotacaoMoeda[$moedaConversao] ?? [];
            return $resultadoCotacaoMoeda;
        } catch (\Throwable $th) {
            return response()->json(['error_code' => 10007, 'error_msg' => 'Error getting response from openai api.'], 404);
        }
    }

    //Função que irá disparar o Job que enviará o email da cotação realizada
    public function emailCotacaoMoeda($params)
    {
        EmailCotacaoMoedaJob::dispatch($params);
    }
}
