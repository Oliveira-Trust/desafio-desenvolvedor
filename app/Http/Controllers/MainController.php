<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\CurrencyTrade;
use App\Models\FeesSetup;
use App\Calculations\CurrencyTradesCalculations;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function trade()
    {
        $currencyDataService = app('App\Contracts\ExternalDataInterface');
        $currencies = json_decode($currencyDataService->getData('/json/last/USD,EUR,GBP,ETH,BTC')->getBody());
        $payment_methods = PaymentMethod::all();

        return view('dashboard', compact('currencies', 'payment_methods'));
    }

    public function tradePost(Request $request)
    {

        $validated = $request->validate([
            'amount_brl' => 'required|numeric|min:1000',
            'currency' => 'required',
            'payment_method' => 'required',
        ]);

        $paymentMethod = PaymentMethod::find($request->payment_method);
        $feesSetup = FeesSetup::first(); 
        $amount_fee = $request->amount_brl>3000 ? $feesSetup->fee_2 : $feesSetup->fee_1;

        $currencyDataService = app('App\Contracts\ExternalDataInterface');
        $currency = json_decode($currencyDataService->getData('/json/last/'.$request->currency)->getBody());
        $currenty_rate = $currency->{$request->currency."BRL"}->ask; 

        $data = [
            "amount_brl" => $request->amount_brl,
            "currency" => $request->currency,
            "currency_rate" => $currenty_rate,
            "user_id" => auth()->user()->id,
            "payment_method_id" => $request->payment_method,
            "payment_method_fee" => $paymentMethod->fee,
            "amount_fee" => $amount_fee,
        ];

        $data["payment_method_fee_value"] = CurrencyTradesCalculations::calculatePaymentMethodFeeValue($data);     
        $data["amount_fee_value"] = CurrencyTradesCalculations::calculateAmountFeeValue($data);     
        $data["amount"] = CurrencyTradesCalculations::calculateAmountNewCurrency($data);     

        $currencyTrade = CurrencyTrade::create($data);

        $fields = [
            'Nome' => auth()->user()->name,
            'Data' => date("d/m/Y H:i:s"),
            'Valor em BRL' => number_format($request->amount_brl, 2, ",", "."),
            'Forma de pagamento' => $paymentMethod->title,
            'Moeda a ser comprada' => $request->currency,
            'Cotação da moeda' => number_format($currenty_rate, 3, ",", "."),
            'Taxa de pagamento' => number_format($data["payment_method_fee_value"], 2, ",", "."),
            'Taxa de conversão' => number_format($data["amount_fee_value"], 2, ",", "."),
            'Valor em moeda estrangeira a ser comprado' => number_format($data["amount"], 2, ".", ","),
        ];
       
        \Mail::to(auth()->user()->email)->send(new \App\Mail\CurrencyTradeEmail($fields));
        $message_email = 'Cotação enviada para o email '.auth()->user()->email;

        if (count(\Mail::failures()) > 0) {
            $message_email = 'Problemas ao enviar cotação para o email '.auth()->user()->email;
        }

        \Session::flash('message', 'Simulação realizada com sucesso. '.$message_email); 

        return redirect()->route('history');
    }

    public function history()
    {
        $itens = CurrencyTrade::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('history', compact('itens'));
    }

}
