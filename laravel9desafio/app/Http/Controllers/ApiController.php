<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use stdClass;

class ApiController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = Http::withHeaders([
            'Authorization' => 'Bearer',
        ]);
    }

    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param  string  $moedadest
     * @param  string  $moedaorigem
     * @return  json
     */
    public function getValorCotacao($moedadest = 'USD',$moedaorigem = 'BRL')
    {
        //'USD-BRL,EUR-BRL'
        $moeda = $moedadest.'-'.$moedaorigem;
        $moedaIdx = $moedadest.''.$moedaorigem;

        $endereco = 'https://economia.awesomeapi.com.br/last/'.$moeda;

        // verificar conexão com a api antes de retornar valor para não dar erro.

        $retornoApi = $this->getApi()->get($endereco);
        $retornoApi = $retornoApi["$moedaIdx"];
        $dadosApi = $this->trataDadosCotacao($retornoApi);

        return $dadosApi;
    }

    protected function trataDadosCotacao($retornoApi)
    {
        $dadosApi = new stdClass();
        $dadosApi->vlCompra = '';
        $dadosApi->vlVenda = '';
        $dadosApi->variacao = '';
        $dadosApi->pctVariacao = '';
        $dadosApi->maximo = '';
        $dadosApi->minimo = '';
        $dadosApi->tipoConversao = '';
        $dadosApi->timestamp = '';
        $dadosApi->dataCriacao = '';
        $dadosApi->origem = '';
        $dadosApi->destino = '';

        foreach($retornoApi as $idx => $valor){

            $dadosApi->vlCompra = $retornoApi['bid'];
            $dadosApi->vlVenda = $retornoApi['ask'];
            $dadosApi->variacao = $retornoApi['varBid'];
            $dadosApi->pctVariacao = $retornoApi['pctChange'];
            $dadosApi->maximo = $retornoApi['high'];
            $dadosApi->minimo = $retornoApi['low'];
            $dadosApi->tipoConversao = $retornoApi['name'];
            $dadosApi->timestamp = $retornoApi['timestamp'];
            $dadosApi->dataCriacao = $retornoApi['create_date'];
            $dadosApi->origem = $retornoApi['code'];
            $dadosApi->destino = $retornoApi['codein'];
        }

        return $dadosApi;
    }
}
