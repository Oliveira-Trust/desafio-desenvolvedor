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
    }
    public function isLogged(Request $request, Response $response, Jwt $auth )
    {
        $token = $request->getHeader('Authorization') ? $request->getHeader('Authorization')[0] : null;
        if( empty($token) ){
            throw new \Exception("Acesso Negado");
        }
        if(!$auth->validate($token) ){
            throw new \Exception("Dados de acesso inválidos.");
        }
    }
    public function getContainer($containerName)
    {
        return $this->container->get($containerName);
    }
}