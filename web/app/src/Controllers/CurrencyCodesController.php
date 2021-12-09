<?php

use CurrencyCodesModel;
use Selene\Request\Request;
use Selene\Response\Response;
use Selene\Controllers\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CurrencyCodesController extends BaseController
{
    public function codes(Request $request, Response $response): JsonResponse
    {
        return $response->json(
            [
                'data' => (new CurrencyCodesModel)->getCodes()
            ],
            $response::HTTP_OK
        );
    }
}
