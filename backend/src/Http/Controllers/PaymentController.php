<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\UseCases\Payment\GetAllPaymentTypes;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Http\Controller;

class PaymentController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $paymentRepository = $this->container->get('PaymentRepository');
        $createConversion = new GetAllPaymentTypes($paymentRepository);
        $payments = $createConversion->execute(); 
        return $response->withJson(["status" => "sucesso", "data" => $payments], 200);
    }
}