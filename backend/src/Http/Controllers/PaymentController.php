<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\UseCases\Payment\CreatePaymentType;
use App\Domain\UseCases\Payment\GetAllPaymentTypes;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Http\Controller;

class PaymentController extends Controller
{
    public function index(Request $request, Response $response)
    {
        try{
            $paymentRepository = $this->container->get('PaymentRepository');
            $createConversion = new GetAllPaymentTypes($paymentRepository);
            $payments = $createConversion->execute(); 
            return $response->withJson(["status" => "sucesso", "data" => $payments], 200);
        }catch(\Exception $e){
            $arrayResponse['code'] = 'error';
            $arrayResponse['message'] = $e->getMessage();
            return $response->withJson($arrayResponse);
        }
    }
    public function store(Request $request, Response $response )
    {
        try{
            $data = $request->getParams();
            $paymentRepository = $this->container->get('PaymentRepository');
            $createPayment = new CreatePaymentType($data, $paymentRepository);
            $payment = $createPayment->execute();
            $arrayResponse['code'] = 'sucesso';
            $arrayResponse['message'] = 'Pagamento salvo com sucesso.';
            $arrayResponse['data'] = $payment->toArray();
            return $response->withJson($arrayResponse);
        } catch(\Exception $e){
            $arrayResponse['code'] = 'error';
            $arrayResponse['message'] = $e->getMessage();
            return $response->withJson($arrayResponse);
        }
    }
}