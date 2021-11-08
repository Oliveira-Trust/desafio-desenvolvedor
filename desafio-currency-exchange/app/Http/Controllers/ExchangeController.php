<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Services\ExchangeService;
use App\Http\Requests\ExchangeRequestValidation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as ResponseReturn;
use Illuminate\View\View;

class ExchangeController extends Controller
{
    /* @var ExchangeService */
    private $exchangeService;

    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    public function enterExchangeProccess(ExchangeRequestValidation $request)
    {
        try {
            $request->validated();
            $response = $this->exchangeService->enterExchangeProccess($request->toArray());
        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return view( 'fails', compact('message', 'code')
            );

        }

        return view('details', compact ('response'));
    }
}
