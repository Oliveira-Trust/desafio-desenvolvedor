<?php

namespace App\Http\Controllers;

use App\Builders\QuoteBuilder;
use App\Helpers\Currency;
use App\Http\Requests\CalcConversionQuoteRequest;
use App\Models\PaymentMethod;
use App\Models\Quote;
use App\Services\AwesomeApiQuotes\AwesomeApiQuotesService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    private $feeRules = [
        [
            'rule' => "<",
            'value' => 3000,
            'fee' => 0.02
        ],
        [
            'rule' => ">=",
            'value' => 3000,
            'fee' => 0.01
        ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotes = Quote::where('user_id', '=', Auth::user()->id)->get();
        $quotes = $quotes->map(function ($quote) {
            $quote->conversion_amount = Currency::format($quote->conversion_amount, $quote->currency_origin);
            $quote->currency_value = Currency::format($quote->currency_value, $quote->currency_origin);
            $quote->payment_rate = Currency::format($quote->payment_rate, $quote->currency_origin);
            $quote->conversion_rate = Currency::format($quote->conversion_rate, $quote->currency_origin);
            $quote->conversion_value = Currency::format($quote->conversion_value, $quote->currency_origin);
            $quote->converted_amount = Currency::format($quote->converted_amount, $quote->currency_name);
            return $quote;
        });
        $paymentMethods = PaymentMethod::all('label', 'type')->pluck('label', 'type');
        return view('quotes.index', compact('quotes', 'paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fees = collect([
            [
                'type' => "payment_slip",
                'label' => "Boleto",
                "value" => 0.0145
            ],
            [
                'type' => "credit_card",
                'label' => "Cartão de Crédito",
                "value" => 0.0763
            ]
        ]);

        $service = new AwesomeApiQuotesService();
        $availables = $service->quotes()->available();
        $currencies = [];
        $quote = new Quote();
        $quote->bid = 5.1066;
        foreach ($availables as $key => $value) {
            if (Str::endsWith($key, "BRL")) {
                $currencies += [$key => $value];
            }
        }
        return view('quotes.create', compact('quote', 'fees'), ['currencies' => $currencies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $quote = Quote::create([
            'conversion_amount' => $request->input('conversion_amount'),
            'name' => $request->input('name'),
            'currency_origin' => $request->input('currency_origin'),
            'currency_name' => $request->input('currency_name'),
            'payment_method' => $request->input('payment_method'),
            'fee' => $request->input('fee'),
            'currency_value' => $request->input('currency_value'),
            'payment_rate' => $request->input('payment_rate'),
            'conversion_rate' => $request->input('conversion_rate'),
            'conversion_fee' => $request->input('conversion_fee'),
            'conversion_value' => $request->input('conversion_value'),
            'converted_amount' => $request->input('converted_amount'),
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('quotes.show', ['quote' => $quote]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function calc(CalcConversionQuoteRequest $request)
    {

        $conversion = $request->validated();
        $service = new AwesomeApiQuotesService();
        $quoteData = $service->quotes()->currency($conversion["currency"])[0];
        $quoteBuilder = new QuoteBuilder($this->feeRules);
        $quote = $quoteBuilder
            ->setConversionAmount($conversion['amount'])
            ->setName($quoteData['name'])
            ->setCurrencyOrigin($quoteData['codein'])
            ->setCurrencyName($quoteData['code'])
            ->setPaymentMethod($conversion['payment_method'])
            ->setFee($conversion['fee'])
            ->setCurrencyValue($quoteData['bid'])
            ->calculateFees()
            ->build();
        $quote->conversion_amount = Currency::format($quote->conversion_amount, $quote->currency_origin);
        $quote->currency_value = Currency::format($quote->currency_value, $quote->currency_origin);
        $quote->payment_rate = Currency::format($quote->payment_rate, $quote->currency_origin);
        $quote->conversion_rate = Currency::format($quote->conversion_rate, $quote->currency_origin);
        $quote->conversion_value = Currency::format($quote->conversion_value, $quote->currency_origin);
        $quote->converted_amount = Currency::format($quote->converted_amount, $quote->currency_name);
        return $quote;
    }

    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        $quote = Quote::where('id', '=', $quote->id)->where('user_id', '=', Auth::user()->id)->firstOrFail();
        $service = new AwesomeApiQuotesService();
        $currencies = $service->currencies()->names();
        $paymentMethods = PaymentMethod::all('label', 'type')->pluck('label', 'type');
        $quote->conversion_amount = Currency::format($quote->conversion_amount, $quote->currency_origin);
        $quote->currency_value = Currency::format($quote->currency_value, $quote->currency_origin);
        $quote->payment_rate = Currency::format($quote->payment_rate, $quote->currency_origin);
        $quote->conversion_rate = Currency::format($quote->conversion_rate, $quote->currency_origin);
        $quote->conversion_value = Currency::format($quote->conversion_value, $quote->currency_origin);
        $quote->converted_amount = Currency::format($quote->converted_amount, $quote->currency_name);
        return view('quotes.show', compact('quote', 'currencies', 'paymentMethods'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
