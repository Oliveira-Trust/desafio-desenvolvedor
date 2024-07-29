<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyConversionRequest;
use App\Models\QuoteHistory;
use App\Services\CurrencyConversionService;
use App\Services\EmailService;
use App\Services\QuoteHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ConversionController extends Controller
{   protected $conversionService;
    protected $emailService;
    protected $quoteHistoryService;
    public function __construct(
        CurrencyConversionService $conversionService,
        EmailService $emailService,
        QuoteHistoryService $quoteHistoryService
        )
    {
        $this->conversionService = $conversionService;
        $this->emailService = $emailService;
        $this->quoteHistoryService = $quoteHistoryService;
    }
    public function showViewResults(Request $request)
    {   
        $data = $request->query(); 
        return view('conversion_result', [
            'destination_currency' => $data['destination_currency'],
            'amount' => $data['amount'],
            'payment_method' => $data['payment_method'],
            'conversion_rate' => $data['conversion_rate'],
            'converted_amount' => $data['converted_amount'],
            'payment_fee' => $data['payment_fee'],
            'conversion_fee' => $data['conversion_fee'],
            'net_amount' => $data['net_amount']
        ]);
    }
    public function showViewConversion()
    {
        return view('conversion');
    }
    public function convert(CurrencyConversionRequest $request)  
    {           
        $currency = $request->input('destination_currency');
        $amount = $request->input('amount');
        $payment_method = $request->input('payment_method');      
       //obtem taxa de conversão
       $conversion_rate = $this->conversionService->getConversionRate($currency);  
       $conversion_rate = (float) $conversion_rate;       
       //calcula as taxas
       $fees = $this->conversionService->calculateFees($amount, $payment_method);
       //calcula o valor convertido 
       $converted_amount = $this->conversionService->convert($conversion_rate, $fees);
     
       //armaze no banco de dados para gerar historico futuro
       $data = [
        'user_id' =>  auth()->user()->id,
        'destination_currency' => $currency,
        'amount' => $amount,
        'conversion_rate' => $conversion_rate,        
        'converted_amount' => $converted_amount,
        'payment_fee' => $fees['payment_fee_amount'],
        'conversion_fee' => $fees['conversion_fee_amount'],
        'net_amount' => $fees['net_amount'],
        'payment_method' => $payment_method,
        ];      
        
        QuoteHistory::create($data);  

        return response()->json([
            'success' => true,
            'data' => $data
        ]);        
    }   
    public function sendEmail(Request $request)
    {
        $data = $request->only(['destination_currency', 'amount', 'converted_amount', 'payment_fee_amount', 'conversion_fee_amount', 'net_amount']);
        $this->emailService->sendConversionDetails($data);

        return redirect()->back()->with('status', 'Email enviado com sucesso!');
    }

    public function showHistory()
    {
        $userId = Auth::id();
        $histories = QuoteHistory::where('user_id', $userId)->get();
        return response()->json([
            'data' => $histories
        ]);         
    }
    public function showViewHistory()
    {                
        return view('exchange_history');
    }   
}
