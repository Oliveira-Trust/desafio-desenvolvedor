<?php

namespace Ldmuniz\AwesomeAPIMoedas;

use Exception;
use Ldmuniz\AwesomeAPIMoedas\Connection;

class AwesomeAPIMoedas
{    
    public $http;
    protected $cliente;

    public function __construct()
    {
        $this->http = new Connection;
    }

    public function validatePair(string $pair){
        if(preg_match('/[A-Z]{3}[\-][A-Z]{3}$/', $pair)){
            return true;
        }else{
            return false;
        }
    }

    public function get(string $pair)
    {
        if($this->validatePair($pair)){
            $result = $this->http->get('/json/last/'.$pair);
            return array_shift($result);
        }else{
            throw new Exception("Par ".$pair." mal formatado");
        }
    }    
}