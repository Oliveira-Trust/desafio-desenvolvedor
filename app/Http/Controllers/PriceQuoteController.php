<?php

namespace App\Http\Controllers;

use App\Models\PriceQuote;
use App\Models\PaymentMethod;
use App\Support\CurrencyQuoteApi;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreConvertRequest;

class PriceQuoteController extends Controller
{
    /**
     * Display the login view.
     *
     */
    public function create()
    {
        $currency_quote_client = new CurrencyQuoteApi();
        $currencies = $currency_quote_client->getAvailableCurrencies();

        return view('price-quote.create', [
            'currencies' => $currencies,
            'payment_methods' => PaymentMethod::all(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $price_quotes = PriceQuote::where('user_id', Auth::user()->id)->get();

        return view('price-quote.index', ['price_quotes' =>  $price_quotes]);
    }

    /**
     * Show the confirm password view.
     *
     */
    public function show(PriceQuote $price_quote)
    {
        return view('price-quote.show', ['price_quote' => $price_quote]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreConvertRequest $request
     */
    public function store(StoreConvertRequest $request)
    {   
        $price_quote = PriceQuote::savePriceQuote($request->all());

        if (!$price_quote) {
            alert()->error('Erro','Não foi possível fazer a conversão');
            return back();
        }
        
        return redirect()->route('price-quote-show', ['price_quote' => $price_quote->id]);
    }

    /**
     * Send email result.
     *
     * @param  PriceQuote $history
     */
    public function sendPriceQuoteEmail(PriceQuote $price_quote)
    {
        $price_quote->sendEmail();   

        return back();
    }
}
