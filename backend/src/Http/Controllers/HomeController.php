<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\UseCases\Currency\GetAllCurrency;
use App\Domain\UseCases\Currency\GetCurrency;
use App\Domain\UseCases\Transactions\CreateConversion;
use App\Http\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

final class HomeController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $currecyRepository = $this->container->get('CurrencyRepository');
        $http = $this->container->get('http');
        $getCurrencies = new GetAllCurrency($http, $currecyRepository);
        $dataBind = $getCurrencies->execute();

        return $response->withJson(["status" => "sucesso", "data" => $dataBind], 200);
    }
    public function getCurrency(Request $request, Response $response, $param)
    {
        try {
            $code = $param['code'];
            $currecyRepository = $this->container->get('CurrencyRepository');
            $http = $this->container->get('http');
            $getCurreny = new GetCurrency($http, $currecyRepository);
            $res = $getCurreny->execute($code);
            return $response->withJson(["status" => "sucesso", "data" => $res], 200);
        } catch (\Exception $e) {
            return $response->withJson(["status" => "error", "message" => $e->getMessage()], 404);
        }
    }
}
