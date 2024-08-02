<?php

namespace App\Http\Controllers;

use App\Jobs\JobSendEmail;
use App\Models\Conversion;
use App\Services\CurrencyConverterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CurrencyConverterController extends Controller
{
    protected $currencyConversionService;

    public function __construct(CurrencyConverterService $currencyConversionService)
    {
        $this->currencyConversionService = $currencyConversionService;
    }

    public function index(Request $request)
    {
        $conversions = Conversion::get();
        return view('dashboard', ['conversions' => $conversions]);
    }

    public function show($id)
    {
        $conversion = Conversion::findOrFail($id);
        return view('conversion.show', ['conversion' => $conversion]);
    }    

    public function convert(Request $request)
    {
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'amount' => 'required|numeric|min:1000|max:100000',
            'payment_method' => 'required|string|in:boleto,credit_card',
        ]);

        $from = $request->input('from');
        $to = $request->input('to');
        $amountNoTaxes = (float) $request->input('amount');
        $paymentMethod = $request->input('payment_method');

        $conversionData = $this->currencyConversionService->convertService($from, $to, $amountNoTaxes, $paymentMethod);

        $response = Conversion::create($conversionData);
        $conversionId = $response->id;

        $userEmail = Auth::user()->email;
        JobSendEmail::dispatch($response, $userEmail);
        DB::commit();

        return redirect()->route('conversion.show', ['id' => $conversionId])
            ->with('success', 'Conversão realizada com sucesso!');
    }

    public function delete($id)
    {
        $conversion = Conversion::findOrFail($id);
        $conversion->delete();
        return redirect()->route('dashboard') 
            ->with('success', 'Histórico excluído com sucesso!');
    }
}
