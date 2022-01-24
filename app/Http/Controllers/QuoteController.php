<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Http\Resources\QuoteResource;
use App\Mail\QuoteCreated;
use App\Models\ExchangeFee;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;
use Facades\App\Services\ExchangeRatesService;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function currencies(): JsonResponse
    {
        return response()->json(config('currency.available_currencies'));
    }

    public function index()
    {
        $quotes = Quote::latest()->get();

        return QuoteResource::collection($quotes);
    }

    public function store(QuoteRequest $request)
    {
        $exchangeRates = ExchangeRatesService::getExchangeRates($request->destination_currency);

        $paymentMethod = $request->getPaymentMethod();

        $exchangeFees = ExchangeFee::getFeeByAmount($request->amount)->calculateFee($request->amount);
        $paymentFees = $paymentMethod->calculateFee($request->amount);
        $amount = $request->amount - ($exchangeFees + $paymentFees);

        $quote = auth()->user()->quotes()->create([
            'origin_currency' => 'BRL',
            'destination_currency' => $request->destination_currency,
            'amount' => $request->amount,
            'amount_received' => $amount * $exchangeRates['bid'],
            'amount_converted' => $amount,
            'payment_method' => $request->payment_method,
            'payment_method_fee' =>  $paymentFees,
            'conversion_fee' =>  $exchangeFees,
            'bid' => $exchangeRates['bid'],
            'ask' => $exchangeRates['ask'],
        ]);

        Mail::to(auth()->user()->email)->send(new QuoteCreated($quote));

        return new QuoteResource($quote);

    }
}
