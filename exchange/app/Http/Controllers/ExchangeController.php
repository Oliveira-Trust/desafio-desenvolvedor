<?php

namespace App\Http\Controllers;

use App\Mail\PostMail;
use App\Models\Exchange;
use App\Services\ExchangeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ExchangeController extends Controller
{
    public function __construct(private ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exchanges = Exchange::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('exchange', ['exchanges' => $exchanges]);
    }


    public function store(Request $request)
    {
        $amount = floatval(str_replace(['.', ','], ['', '.'], $request->get('amount')));
        $paymentMethod = $request->get('payment_method');
        $targetCurrency = $request->get('target-currency');
        $destinationCurrency = $request->get('destination-currency');

        $exchangeRateData = $this->exchangeService->fetchExchangeValues($destinationCurrency . '-' . $targetCurrency);
        $conversionResult = $this->exchangeService->calculateConversion($amount, $paymentMethod, $exchangeRateData);
        $conversionResult['user_id'] = auth()->id();

        Exchange::create($conversionResult);

        return redirect()->route('exchange')->with('status', 'exchange-added');
    }

    /**
     * Update the specified resource in storage.
     */
    public function email(int $id)
    {
        $exchange = Exchange::where('id', $id)->first();

        Mail::to(auth()->user()->email)->send(new PostMail(['exchange' => $exchange]));

        return redirect()->route('exchange')->with('status', 'email-sent');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Exchange::destroy($id);

        return redirect()->route('exchange');
    }
}
