<?php

namespace App\Http\Controllers;

use App\Libraries\ExchangeRatesService;
use App\Models\Currency;
use App\Models\ExchangeTax;
use App\Models\Exchange;
use App\Models\PaymentMethod;
use App\Notifications\ExchangeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GuestController extends Controller
{
    public function index(){
        if (!Auth::check()) {
            Session::flash('info', "Deseja receber esta cotação em seu e-mail? Faça o login!");
        }
        
        $min = ExchangeTax::min('from');
        $max = ExchangeTax::max('to');        

        $view = view('guest.index');
        $view->with('max',$max)->with('min',$min);
        $view->with('payment_methods', PaymentMethod::all());
        $view->with('currencies', Currency::where('default',false)->get());
        return $view;
    }

    public function results(Request $request){

        $api = new ExchangeRatesService();
        $currency = Currency::find($request->currency_id);
        $rate = $api->getRate($currency->isocode);
        $payment_method = PaymentMethod::find($request->payment_method_id);

        $exchange_tax = ExchangeTax::getTax($request->ask)->first()->tax->value;
        $default_isocode = Currency::getDefaultCurrency()->isocode;

        $user = Auth::user();
        $exchange = new Exchange();
        $exchange->currency_id = $request->currency_id;
        $exchange->payment_method_id = $payment_method->id;
        $exchange->ask = $request->ask;
        $exchange->rate = $rate;
        $exchange->payment_tax = $payment_method->tax->value;
        $exchange->exchange_tax = $exchange_tax;  
        if($user){
            $exchange->user_id = Auth::user()->id;
            $exchange->save();
        }else{
            Session::put('exchange',$exchange->toJson());
        }                
        
        $view = view('guest.show');
        $view->with('exchange',$exchange);
        $view->with('default_isocode',$default_isocode);
        return $view;
    }
    
    public function postStore(){
        if(Session::has('exchange')){
            $exchange = Session::get('exchange');
            $data = json_decode($exchange,true);

            if(json_last_error() != JSON_ERROR_NONE)
                return response()->json(['msg' => 'json_error']);

            $exchange = new Exchange();
            $exchange->hydrate($data);
            $exchange->user_id = Auth::user()->id;
            $exchange->save();

            return response()->json(['msg' => 'ok']);
        }else{
            return response()->json(['msg' => 'not_found']);
        }
    }

    public function show(int $exchange_id){
        $exchange = Exchange::find($exchange_id);
        $default_isocode = Currency::getDefaultCurrency()->isocode;        

        $view = view('guest.show');
        $view->with('exchange',$exchange);
        $view->with('default_isocode',$default_isocode);
        return $view;
    }

    public function sendMail(int $exchange_id){        
        $user = Auth::user();
        $user->notify(new ExchangeRequest($exchange_id));
        Session::flash('success', 'Um e-mail será enviado');
        return redirect()->route('exchange.show', ['exchange_id' => $exchange_id]);
    }

    public function history(){
        $user = Auth::user();
        $exchanges = Exchange::where('user_id',$user->id)->get();
        $default_isocode = Currency::getDefaultCurrency()->isocode;
        return view('guest.history')->with('exchange',$exchanges)->with('default_isocode',$default_isocode);
    }

    
}
