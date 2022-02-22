<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CurrencyConversionService;
use App\Http\Requests\CurrencyConversionGetRequest;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

class CurrencyConversionController extends Controller
{
    private $currencyConversion;

    public function __construct(CurrencyConversionService $currencyConversion)
    {
        $this->currencyConversion = $currencyConversion;
    }

    public function currencyConversion(CurrencyConversionGetRequest $request)
    {
        $data = $request->validated();

        return response()->json(
            $this->currencyConversion->currencyConversion($data),
            HttpStatusCode::HTTP_OK
        );
    }
}
