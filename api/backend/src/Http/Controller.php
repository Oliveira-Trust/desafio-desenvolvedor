<?php

namespace App\Http;

class Controller
{ 
    public $auth;
    public $http;
    public $request;
    public $container;
    public function __construct($request, $container)
    {
        $this->auth = getAuth();
        $this->http = getHttp();
        $this->request = $request;
        $this->container = $container;
    }
    public function response($array = [])
    {
        // header('HTTP/1.1 200');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Max-Age: 1000');
        header('Content-Type: application/json');
        echo json_encode($array);
        exit;
    }
    public function isLogged()
    {
        $request = $this->request;
        $headerRequest = $request->getHeaders();
        $token = $headerRequest['Authorization'] ?? null;
        if( empty($token) ){
            throw new \Exception("Acesso Negado");
        }
        if(!$this->auth->validate($token) ){
            throw new \Exception("Dados de acesso inválidos.");
        }
    }
}
