<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ConversionController extends Controller
{
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
