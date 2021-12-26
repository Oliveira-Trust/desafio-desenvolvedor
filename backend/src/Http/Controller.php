<?php

declare(strict_types=1);

namespace App\Http;

use App\Service\Jwt\Jwt;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class Controller
{
    public $container;

    public function __construct(\Slim\Container $c)
    {
        $this->container = $c;
        $this->http = $c->get('http');
    }
    public function isLogged(Request $request, Response $response, Jwt $auth )
    {
        $token = $request->getHeader('Authorization') ? $request->getHeader('Authorization')[0] : null;
        if( empty($token) ){
            return $response->withJson(["code"=>"erro", "message"=>"Acesso Negado"]);
        }
        if(!$auth->validate($token) ){
            return $response->withJson(["code"=>"erro", "message"=>"Acesso Negado"]);
        }
    }
    public function getContainer($containerName)
    {
        return $this->container->get($containerName);
    }
}