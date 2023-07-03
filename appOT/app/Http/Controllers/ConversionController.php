<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConversionController extends Controller
{
    public function convert(Request $request)
    {
  
        $request->validate([
            'destination_currency' => 'required',
            'conversion_value' => 'required|numeric|min:1000|max:100000',
            'payment_method' => 'required|in:boleto,cartao',
        ]);

        $destinationCurrency = $request->input('destination_currency');
        $conversionValue = $request->input('conversion_value');
        $paymentMethod = $request->input('payment_method');

        // Obter o valor de conversão da API
        $response = Http::get('https://economia.awesomeapi.com.br/last/BRL-USD');

        if ($response->ok()) {
            $conversionRate = $response['BRLUSD']['bid']; // Substitua 'USD' pela moeda desejada

            // Calcular o valor convertido
            $convertedValue = $conversionValue * $conversionRate;

            // Aplicar as taxas de pagamento
            $paymentRate = $paymentMethod == 'boleto' ? 0.0145 : 0.0763;
            $paymentFee = $convertedValue * $paymentRate;

            // Aplicar a taxa de conversão
            $conversionFee = $conversionValue < 3000 ? $conversionValue * 0.02 : $conversionValue * 0.01;

            // Calcular o valor total descontando as taxas
            $totalValue = $convertedValue - $paymentFee - $conversionFee;

            // Salvar a conversão no banco de dados
            $conversion = Conversion::create([
                'origin_currency' => 'BRL',
                'destination_currency' => $destinationCurrency,
                'conversion_value' => $conversionValue,
                'converted_value' => $convertedValue,
                'payment_method' => $paymentMethod,
            ]);

            return response()->json([
                'conversion' => $conversion,
                'conversion_rate' => $conversionRate,
                'payment_fee' => $paymentFee,
                'conversion_fee' => $conversionFee,
                'total_value' => $totalValue,
            ]);
        } else {
            return response()->json(['error' => 'Failed to fetch conversion rate.'], 500);
        }
    }
}
