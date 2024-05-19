<?php

namespace App\Http\Controllers;

use App\Builders\QuoteBuilder;
use App\Http\Requests\CalcConversionQuoteRequest;
use App\Models\Quote;
use App\Services\AwesomeApiQuotes\AwesomeApiQuotesService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Services\AwesomeApiQuotes\Entities\Quote as QuoteEntity;

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
        return view('quotes.index');
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
        dd($request->input());
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

        logger($quote);
        return $quote;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('quotes.show');
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
