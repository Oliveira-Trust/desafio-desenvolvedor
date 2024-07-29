<?php

namespace App\Http\Controllers\Api\Exchange;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exchange\StoreExchangeRequest;
use App\Http\Resources\ExchangeResource;
use App\Models\Exchange;
use App\Models\Fee;
use App\Models\PaymentMethod;
use App\Services\ExchangeAPI;
use Illuminate\Http\JsonResponse;

class ExchangeController extends Controller
{

    public function __construct(private ExchangeAPI $exchangeApi = new ExchangeAPI())
    {
    }

    public function index(): JsonResponse
    {
        $exchange = Exchange::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return response()->json(ExchangeResource::collection($exchange));
    }

    public function store(StoreExchangeRequest $request): JsonResponse
    {
        $payload = $request->validated();
        $exchangeData = $this->requestExchange($payload['end_currency']);

        $exchangeRate = $this->getExchangeRate(
            $this->formatDatabaseAmount($payload['amount']),
            PaymentMethod::findOrFail($payload['payment_method_id']),
            $exchangeData
        );

        $exchange = Exchange::create(
            [
                'user_id' => auth()->user()->id,
                'origin_currency' => 'BRL',
                'end_currency' => $payload['end_currency'],
                'amount' => $payload['amount'],
                'payment_method_id' => $payload['payment_method_id'],
                ...$exchangeRate
            ]
        );

        return response()->json(new ExchangeResource($exchange));
    }

    public function show(Exchange $exchange): JsonResponse
    {
        return response()->json(new ExchangeResource($exchange));
    }

    private function requestExchange($endCurrency)
    {
        $response = $this->exchangeApi->makeRequest($endCurrency);
        return array_pop($response);
    }

    private function getExchangeRate(string $amount, PaymentMethod $paymentMethod, array $exchangeData)
    {
        $conversionFeeAmount = $amount * $this->getTransactionFee($amount);
        $paymentMethodFee = $amount * ($paymentMethod->fee / 100);

        $amount_converted = $amount - $conversionFeeAmount - $paymentMethodFee;
        $end_currency_amount = ($amount_converted / $exchangeData['bid']);

        return [
            'end_currency_amount' => $this->formatDatabaseAmount($end_currency_amount),
            'payment_fee' => $this->formatDatabaseAmount($paymentMethodFee),
            'conversion_fee' => $this->formatDatabaseAmount($conversionFeeAmount),
            'amount_converted' => $this->formatDatabaseAmount($amount_converted),
        ];
    }

    private function getTransactionFee(string $amount)
    {
        $fees = Fee::orderBy('applied_when_lower', 'ASC')->get();

        $feeApplied = $fees->firstWhere(function ($item) use ($amount) {
            return $item['applied_when_lower'] >= $amount;
        });

        return $feeApplied->rate / 100;
    }

    private function formatDatabaseAmount(string $amount)
    {
        return number_format($amount, 2, '.', '');
    }
}
