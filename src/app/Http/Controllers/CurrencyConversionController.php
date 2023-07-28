<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use App\Models\Quotation;
use Illuminate\Support\Facades\Mail;
use App\Mail\CotacaoRealizadaEmail; 
use Log;

class CurrencyConversionController extends Controller
{
    // Method to display the form for performing the conversion
    public function index()
    {
        return view('currency_conversion.index');
    }

    // Method to process the form and display the conversion result
    public function convert(Request $request)
    {
        // Form field validation
        $request->validate([
            'currency_destination' => 'required|string',
            'amount' => 'required|numeric|min:1000|max:100000',
            'payment_method' => 'required|in:Boleto,Cartão de Crédito',
        ]);

        // After validation, proceed with the conversion logic
        $currencyDestination = $request->input('currency_destination');
        $amount = $request->input('amount');
        $paymentMethod = $request->input('payment_method');

        // Business rules validation
        if ($request->input('currency_destination') === 'BRL') {
            return back()->withErrors('The destination currency must be different from BRL.');
        }

        $availableCurrencies = ['USD', 'EUR', 'BTC']; // Example of available currencies for conversion

        if (!in_array($currencyDestination, $availableCurrencies)) {
            return back()->withErrors('Invalid destination currency.');
        }

        // Check if the purchase amount is within the allowed range
        if ($amount < 1000 || $amount > 100000) {
            return back()->withErrors('The conversion amount must be between R$ 1,000.00 and R$ 100,000.00.');
        }

        // Verify the payment method and apply the correct tax rate
        if ($paymentMethod === 'Boleto') {
            $paymentTax = 1.45;
        } elseif ($paymentMethod === 'Cartão de Crédito') {
            $paymentTax = 7.63;
        } else {
            return back()->withErrors('Invalid payment method.');
        }

        // Apply the conversion rate based on the purchase amount (excluding the payment method tax)
        $conversionTax = $amount >= 3000 ? 0.01 : 0.02;
        $amountWithConversionTax = $amount + ($amount * $conversionTax);

        // Obtain the exchange rate of the destination currency through the AwesomeAPI API
        $handlerStack = HandlerStack::create(new CurlHandler());

        $client = new Client([
            'handler' => $handlerStack,
            'verify' => false, // Disable SSL certificate verification
        ]);
        $response = $client->get("https://economia.awesomeapi.com.br/last/{$currencyDestination}-BRL");
        $data = json_decode($response->getBody(), true);

        // Check if the API returned the data correctly
        if (!isset($data["{$currencyDestination}BRL"]["bid"])) {
            return back()->withErrors('Failed to obtain the destination currency exchange rate.');
        }

        // Calculate the foreign currency value based on the API obtained exchange rate
        $conversionRate = $data["{$currencyDestination}BRL"]["bid"];
        $foreignAmount = $amount / $conversionRate; // The conversion rate has already been applied to the purchase amount

        // Successful quotation, send the email
        if (auth()->check()) {
            $data = [
                'userName' => auth()->user()->name,
                'currencyOrigin' => 'BRL',
                'currencyDestination' => $currencyDestination,
                'amount' => $amount,
                'paymentMethod' => $paymentMethod,
                'paymentTax' => $paymentTax,
                'conversionTax' => $conversionTax,
                'amountWithConversionTax' => $amountWithConversionTax,
                'conversionRate' => $conversionRate,
                'foreignAmount' => $foreignAmount,
            ];

            Mail::to(auth()->user()->email)->send(new CotacaoRealizadaEmail($data));

            // Add log to track email sending
            Log::info('Email sent to: ' . auth()->user()->email);
        }

        // Save the performed quotation in the quotations table
        Quotation::create([
            'user_id' => auth()->id(),
            'currency_origin' => 'BRL',
            'currency_destination' => $currencyDestination,
            'amount' => $amount,
            'payment_method' => $paymentMethod,
            'payment_tax' => $paymentTax,
            'conversion_tax' => $conversionTax,
            'amount_with_conversion_tax' => $amountWithConversionTax,
            'conversion_rate' => $conversionRate,
            'foreign_amount' => $foreignAmount,
        ]);

        // If it reached this point, the data has been validated correctly, and the conversion can be performed
        return view('currency_conversion.result', [
            'currencyOrigin' => 'BRL', 
            'currencyDestination' => $currencyDestination,
            'amount' => $amount,
            'paymentMethod' => $paymentMethod,
            'paymentTax' => $paymentTax,
            'conversionTax' => $conversionTax,
            'amountWithConversionTax' => $amountWithConversionTax,
            'conversionRate' => $conversionRate,
            'foreignAmount' => $foreignAmount,
        ]);
    }


    // Method to display quotations for the authenticated user
    public function viewQuotations()
    {
        // Fetch the quotations associated with the authenticated user
        $quotations = Quotation::where('user_id', auth()->id())->get();

        // Return the view with the quotations data
        return view('currency_conversion.quotations', ['quotations' => $quotations]);
    }



}
