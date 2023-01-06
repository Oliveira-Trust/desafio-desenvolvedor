<?php

namespace Modules\Exchange\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Exchange\Http\Requests\CreateExchangeRequest;
use Modules\Exchange\Jobs\ExchangeConversionJob;
use Modules\Exchange\Services\ExchangeService;
use Modules\Exchange\Services\RatesService;
use Modules\Exchange\Transformers\ExchangeResource;

class ExchangeController extends Controller
{
    public function __construct(protected ExchangeService $exchangeService, protected RatesService $ratesService)
    {
    }

    /** @return JsonResponse|void  */
    public function index()
    {
        try {
            $exchanges = $this->exchangeService->list();

            return response()->json(
                ExchangeResource::collection($exchanges)->response()->getData(),
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $th) {
            return response()->json([], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param CreateExchangeRequest $request
     * @return JsonResponse|void
     */
    public function conversion(CreateExchangeRequest $request)
    {
        try {
            $rates = $this->ratesService->list();

            ExchangeConversionJob::dispatchIf(
                $rates,
                $request->destination_currency,
                $request->conversion_value,
                $request->payment_method,
                Auth::user(),
                $this->exchangeService,
                $rates
            );
        } catch (\Throwable $th) {
            return response()->json([], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /** @return JsonResponse|void  */
    public function paymentMethods()
    {
        try {
            $paymentMethods = $this->exchangeService->paymentMethods();

            return response()->json($paymentMethods, JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function currencies()
    {
        try {
            $currencies = $this->exchangeService->currencies();

            return response()->json($currencies, JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
