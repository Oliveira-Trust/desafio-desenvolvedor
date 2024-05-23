<?php

namespace App\Http\Controllers;

use App\Builders\QuoteBuilder;
use App\Http\Requests\CalcConversionQuoteRequest;
use App\Mail\QuoteCreated;
use App\Models\ConversionAvailable;
use App\Models\Currency;
use App\Models\FeeRule;
use App\Models\PaymentMethod;
use App\Models\Quote;
use App\Services\AwesomeApiQuotes\AwesomeApiQuotesService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{

    private AwesomeApiQuotesService $service;
    private PaymentMethod $paymentMethods;
    private FeeRule $feeRules;
    private Currency $currency;
    private ConversionAvailable $conversionAvailable;

    public function __construct()
    {
        $this->service = new AwesomeApiQuotesService();
        $this->paymentMethods = new PaymentMethod();
        $this->feeRules = new FeeRule();
        $this->currency = new Currency();
        $this->conversionAvailable = new ConversionAvailable();
    }

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
        $paymentMethods = $this->paymentMethods->select('label', 'type')->get()->pluck('label', 'type');
        return view('quotes.index', compact('quotes', 'paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paymentMethods = $this->paymentMethods->get();
        $currencies = $this->conversionAvailable->where('code', 'like', '%-BRL')->get()->pluck('name', 'code');
        $quote = new Quote();
        return view('quotes.create', compact('quote', 'paymentMethods'), ['currencies' => $currencies]);
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
        $currencies = $this->currency->get()->pluck('name', 'code');
        $paymentMethods = $this->paymentMethods->select('label', 'type')->get()->pluck('label', 'type');
        Mail::to($request->user())->queue(new QuoteCreated($quote, Auth::user(), $currencies, $paymentMethods));
        return redirect(route('quotes.show', ['quote' => $quote]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function calc(CalcConversionQuoteRequest $request)
    {
        try {
            $conversion = $request->validated();
            $quoteData = $this->service->quotes()->currency($conversion["currency"])[0];
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
            return $quote;
        } catch (\Throwable $th) {
            return response("Error", 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        $quote = Quote::where('id', '=', $quote->id)->where('user_id', '=', Auth::user()->id)->firstOrFail();
        $currencies = Currency::all()->pluck('name', 'code');
        $paymentMethods = $this->paymentMethods->select('label', 'type')->get()->pluck('label', 'type');
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
