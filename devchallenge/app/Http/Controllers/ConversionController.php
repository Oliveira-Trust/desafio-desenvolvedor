<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\CurrencyDestiny;
use App\Models\ConversionHistory;
use App\Models\User;
use App\Http\Requests\CreateConversionRequest;
use App\Services\ConversionMath;
use App\Events\ConversionHistoryCreated;

class ConversionController extends Controller
{
    /**
     * Display the currency conversion screen.
     *
     * @return \Illuminate\View\View
    */
    public function get()
    {
        $user = User::findOrFail(auth()->user()->id);

        $paymentMethod = PaymentMethod::all();
        $currencyDestiny = CurrencyDestiny::all();

        $conversionHistory = $user->conversion()->orderBy('created_at', 'desc')->paginate(5);
        
        return view('currency/index', 
            [
                'conversion_history' => $conversionHistory,
                'payment_method' => $paymentMethod,
                'currency_destiny' => $currencyDestiny
            ]
        );
    }

    public function create(CreateConversionRequest $request)
    {
        $ConversionMath = new ConversionMath();
        $response = $ConversionMath->calcConversion($request);

        event(new ConversionHistoryCreated(auth()->user(), $response));

        return redirect()->route('currency.conversion')
            ->with('message', 'Conversion request successfully');
    }
}
