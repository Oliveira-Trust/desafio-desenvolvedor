<?php

use Selene\Controllers\BaseController;
use Selene\Request\Request;
use Selene\Response\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PaymentController extends BaseController
{
    public function getPaymentMethods(Request $request, Response $response): JsonResponse
    {
        return $response->json(
            [
                'from' => 0,
                'size' => 2,
                'data' => (new PaymentModel)->getMethods()
            ],
            $response::HTTP_OK
        );
    }
}
