<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{   

    public $response;


    const BASE_URL = 'https://economia.awesomeapi.com.br/json';

     /**
     * Método responsável por consultar a cotação atual das moedas
     *
     * @param string $moedaA
     * @param string $moedaB
     * @return array 
     */

    public function getQuotesCoins($moedaA, $moedaB) 
    {
       return $this->get('/last/'.$moedaA. '-'. $moedaB);
    }

     /**
     * Método responsável por executar a requisição na API Awesome
     *
     * @param string $moedaA
     * @return array 
     */
    public function get($resource) 
    {
        $endpoint = self::BASE_URL.$resource;
        
        //inicia a curl
        $curl = curl_init();
        
        // configurando o curl
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        
        // executa o curl
        $this->response = curl_exec($curl);
       
        // fecha a conexao do curl
        curl_close($curl);

        // retorna o json como array 
        return json_decode($this->response, true);
    }
}

