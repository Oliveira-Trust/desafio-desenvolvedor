<?php

namespace Ldmuniz\AwesomeAPIMoedas;

use Exception;
use GuzzleHttp\Client;

class Connection {
    
    public $http;
    public $api_key;
    public $base_url;
    
    public function __construct() {
        $parms = [
                    'headers' => [
                        'Content-Type' => 'application/json'                        
                    ],
                ];        
        $parms['verify'] = false;  
        $this->base_url = 'https://economia.awesomeapi.com.br';
        $this->http = new Client($parms);        
        return $this->http;
    }
    
    public function get($url)
    {
        try{
            $response = $this->http->get($this->base_url . $url);
            $result = $response->getBody()->getContents();
            $array = json_decode( $result ,true);
            if(json_last_error() != JSON_ERROR_NONE){
                throw new Exception("Erro ao decodificar JSON");
            }
            return $array;
        }catch(\GuzzleHttp\Exception\ClientException $e){
            throw new Exception($e->getResponse()->getBody()->getContents());
        }
    }    
}