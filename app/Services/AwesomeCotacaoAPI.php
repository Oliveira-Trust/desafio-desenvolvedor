<?php

namespace App\Services;

use App\Models\Cotacao;
use Illuminate\Support\Facades\Http;

class AwesomeCotacaoAPI implements CotacaoAPI
{

    public function cotar(string $moeda_origem, string $moeda_destino): Cotacao
    {

        $response = Http::get('https://economia.awesomeapi.com.br/json/last/' . $moeda_destino . '-' . $moeda_origem);
        $result = (array) json_decode($response->body());

        $cotacao = $this->gravaCotacao($result[$moeda_destino.$moeda_origem]);

        return $cotacao;

    }

    public function gravaCotacao($result): Cotacao
    {

        $cotacao = new Cotacao();
        $cotacao->code = $result->code;
        $cotacao->codein = $result->codein;
        $cotacao->name = $result->name;
        $cotacao->high = $result->high;
        $cotacao->low = $result->low;
        $cotacao->varBid = $result->varBid;
        $cotacao->pctChange = $result->pctChange;
        $cotacao->bid = $result->bid;
        $cotacao->ask = $result->ask;
        $cotacao->timestamp = $result->timestamp;
        $cotacao->create_date = $result->create_date;
        $cotacao->save();

        return $cotacao;
    }
}
