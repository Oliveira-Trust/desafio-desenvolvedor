<?php
namespace App\Services;
use App\Http\Middleware\CorsMiddleware;
use App\Http\Middleware;
use GuzzleHttp\Client;


class ConversaoService
{
    private $MOEDAS_AWESOME_API_URL;

    /**
     * 
     * @return void;
     */
    
    public function __construct()
    {
        $this->MOEDAS_AWESOME_API_URL = 'https://economia.awesomeapi.com.br/json/';
    }

    public function converter($de, $para) 
    {
        $client = new Client();
        
        $res = $client->request('GET', $this->MOEDAS_AWESOME_API_URL . 'last/' . $de . '-' . $para, ['verify' => false ]);    
        return $res->getBody();
    }
}
