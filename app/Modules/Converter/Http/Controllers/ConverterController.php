<?php

namespace Converter\Http\Controllers;

use App\Http\Controllers\Controller;
use Converter\Enums\PaymentType;
use Converter\Rules\PaymentRangeRule;
use Converter\Services\ConverterService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ConverterController extends Controller
{
    public function __construct(
        protected ConverterService $converterService
    ) {
    }

    public function getCurrencies()
    {
        return response()->json(
            $this->converterService->getCurrencies(),
            Response::HTTP_OK
        );
    }

    public function payment(Request $request)
    {
        $data = $request->only([
            'currency', 'value', 'type'
        ]);

        $currenciesKeys = array_keys($this->converterService->getCurrencies());

        $validator = Validator::make(
            $data,
            [
                'currency' => ['required', 'bail', Rule::in($currenciesKeys)],
                'value' => ['required', 'bail', App::make(PaymentRangeRule::class)],
                'type' => ['required', 'bail', Rule::in(PaymentType::all())]
            ]
        );

        if($validator->fails()) {
            return response()->json(
                $validator->errors(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $payment = $this->converterService->makePayment($data);

        $payment = array_merge(
            $payment->getTaxes(),
            $payment->toArray()
        );

        return response()->json(
            $payment,
            Response::HTTP_OK
        );
    }
}
