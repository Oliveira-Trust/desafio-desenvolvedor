<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\UseCases\Transactions\CreateConversion;
use App\Http\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

final class TransactionController extends Controller
{
    public function exchange(Request $request, Response $response, $parameters)
    {
        $userId = (int) $parameters['userId'];
        $data = $request->getParams();
        $userRepository = $this->container->get('UserRepository');
        $paymentRepository = $this->container->get('PaymentRepository');
        $currencyRepository = $this->container->get('CurrencyRepository');
        $transactionRepository = $this->container->get('TransactionRepository');

        $createConversion = new CreateConversion(
            $data,
            $userId,
            $transactionRepository,
            $currencyRepository,
            $paymentRepository,
            $userRepository
        );
        $transaction = $createConversion->execute();
        return $response->withJson(["status" => "sucesso", "data" => $transaction], 200);
    }
}
