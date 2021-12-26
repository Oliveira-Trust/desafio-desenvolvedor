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
    public function exchenge(Request $request, Response $response, $param)
    {
        $userId = (int) $param['userid'];
        $data = $request->getParams();
        $userRepository = $this->container->get('UserRepository');
        $currencyRepository = $this->container->get('CurrencyRepository');
        $transactionRepository = $this->container->get('TransactionRepository');

        $createConversion = new CreateConversion(
            $data,
            $userId,
            $transactionRepository,
            $currencyRepository,
            $paymentRepository
            $userRepository
        );
        $transaction = $createConversion->execute();

        return $response->withJson(["status" => "sucesso", "data" => $data], 200);
    }
}
