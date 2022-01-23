<?php

namespace App\Helper;

use GuzzleHttp\Client;
/*
* Api  para pegar cotacao atual das moedas 
* 
*
*/
trait ApiEconomiaAwesome
{
    
    protected $baseUrl;

    protected $client;

    public function __construct()
    {
        $this->baseUrl = "https://economia.awesomeapi.com.br/";
        $this->client = new Client();
    }

    /**
     * Busca a cotacao sempre atual
     *
     * @param  $from  moeda de $to
     * @return \Illuminate\Http\Response
     */

    public function getCurrentQuote(string $from, string $to)
    {
        $headerResponse = $from . $to;
        $response       = $this->client->get($this->baseUrl . 'last/'. $from . "-" . $to);
        $json           = json_decode($response->getBody()->getContents());

        return $json->$headerResponse->high;
    }

    /**
     * Busca todas as combinacoes possiveis e depois filtra
     * Essa rotina  vai ser usada apenas numa futura feature
     * @param  $from  moeda de $to
     * @return \Illuminate\Http\Response
     */

    public function getPossibleCombinations()
    {
        $response = $this->client->get($this->baseUrl . 'json/available/');
        $stream = $response->getBody()->getContents();
        $json = json_decode($stream);


        return $json->$headerResponse->high;
    }


}