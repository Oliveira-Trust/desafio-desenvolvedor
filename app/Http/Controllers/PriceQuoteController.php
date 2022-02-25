<?php

namespace App\Http\Controllers;

use App\Models\PriceQuote;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreConvertRequest;

class PriceQuoteController extends Controller
{
    /**
     * Display the create view.
     *
     */
    public function create()
    {
        return view('price-quote.create', [
            'currencies' => array_keys(PriceQuote::AVAILABLE_CURRENCIES),
            'payment_methods' => PaymentMethod::all(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $price_quotes = PriceQuote::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();

        return view('price-quote.index', ['price_quotes' =>  $price_quotes]);
    }

    /**
     * Display the specified resource.
     *
     * @param  PriceQuote $price_quote
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
     * Send email price quote
     *
     * @param  PriceQuote $history
     */
    public function sendPriceQuoteEmail(PriceQuote $price_quote)
    {
        $price_quote->sendEmail();   

        return back();
    }
}
