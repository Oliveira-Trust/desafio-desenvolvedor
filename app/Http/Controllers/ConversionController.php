<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConversionRequest;
use App\Models\Conversion;
use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Services\ConversionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class ConversionController extends Controller
{
    public function __construct(
        private ConversionService $conversionService
    ) {
    }

    public function create(Request $request, Conversion $conversion)
    {
        return Inertia::render('Conversion/Create', [
            'currencies' => Currency::all(),
            'paymentMethods' => PaymentMethod::enabled()->get(),
            'currentConversion' => $conversion,
            'conversions' => auth()->check()
                ? $request->user()->conversions()->orderBy('created_at', 'desc')->get()
                : []
        ]);
    }

    public function store(StoreConversionRequest $request)
    {
        $validated = $request->validated();

        $response = Http::awesome()->get("/last/{$validated['target_currency']}-BRL");

        if ($response->failed()) {
            return back()->with('error-message', 'Serviço temporariamente indisponível! Tente mais tarde.');
        }

        $bid = $response->json()["{$validated['target_currency']}BRL"]['bid'];

        $result = $this->conversionService->calculateTargetAmount(
            $bid,
            $validated['amount'],
            $validated['payment_method_id']
        );

        $conversion = Conversion::create([
            'bid' => (float) $bid,
            'amount' => (float) $validated['amount'],
            'payment_method_id' => $validated['payment_method_id'],
            'target_currency' => $validated['target_currency'],
            'currency' => 'BRL',
            'payment_fee' => $result['paymentFee'],
            'amount_fee' => $result['amountFee'],
            'target_amount' => $result['targetAmount'],
            'user_id' => auth()->check() ? $request->user()->id : null,
        ]);

        return redirect()->back()->with('current-conversion', $conversion->loadMissing('paymentMethod'));
    }
}
