<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use App\Models\Quotation;


class CurrencyConversionController extends Controller
{
    // Método para exibir o formulário para realizar a conversão
    public function index()
    {
        return view('currency_conversion.index');
    }

    // Método para processar o formulário e exibir o resultado da conversão
    public function convert(Request $request)
    {
        // Validação dos campos do formulário
        $request->validate([
            'currency_destination' => 'required|string',
            'amount' => 'required|numeric|min:1000|max:100000',
            'payment_method' => 'required|in:Boleto,Cartão de Crédito',
        ]);

        // Após a validação, você pode prosseguir com a lógica de conversão
        $currencyDestination = $request->input('currency_destination');
        $amount = $request->input('amount');
        $paymentMethod = $request->input('payment_method');

        // Validação das regras de negócio
        if ($request->input('currency_destination') === 'BRL') {
            return back()->withErrors('A moeda de destino deve ser diferente de BRL.');
        }

        $availableCurrencies = ['USD', 'EUR', 'BTC']; // Exemplo de moedas disponíveis para conversão

        if (!in_array($currencyDestination, $availableCurrencies)) {
            return back()->withErrors('Moeda de destino inválida.');
        }

        // Verificar se o valor da compra está dentro do intervalo permitido
        if ($amount < 1000 || $amount > 100000) {
            return back()->withErrors('O valor para conversão deve ser entre R$ 1.000,00 e R$ 100.000,00.');
        }

        // Verificar a forma de pagamento e aplicar a taxa correta
        if ($paymentMethod === 'Boleto') {
            $paymentTax = 1.45;
        } elseif ($paymentMethod === 'Cartão de Crédito') {
            $paymentTax = 7.63;
        } else {
            return back()->withErrors('Forma de pagamento inválida.');
        }

      // Aplicar a taxa de conversão baseada no valor da compra (sem incluir a taxa de forma de pagamento)
      $conversionTax = $amount >= 3000 ? 0.01 : 0.02;
      $amountWithConversionTax = $amount + ($amount * $conversionTax);

        // Obter a cotação da moeda de destino através da API AwesomeAPI
        $handlerStack = HandlerStack::create(new CurlHandler());

        $client = new Client([
            'handler' => $handlerStack,
            'verify' => false, // Desabilitar a verificação do certificado SSL
        ]);
        $response = $client->get("https://economia.awesomeapi.com.br/last/{$currencyDestination}-BRL");
        $data = json_decode($response->getBody(), true);

        // Verificar se a API retornou os dados corretamente
        if (!isset($data["{$currencyDestination}BRL"]["bid"])) {
            return back()->withErrors('Não foi possível obter a cotação da moeda de destino.');
        }

        // Cálculo do valor em moeda estrangeira com base na cotação obtida da API
        $conversionRate = $data["{$currencyDestination}BRL"]["bid"];
        $foreignAmount = $amount / $conversionRate; // A taxa de conversão já foi aplicada no valor da compra

        // Implemente o restante da lógica de conversão aqui

        //  // Cotação realizada com sucesso, enviar o email
        //     Mail::to('email_destinatario')->send(new CotacaoRealizadaEmail([
        //         'currencyOrigin' => 'BRL',
        //         'currencyDestination' => $currencyDestination,
        //         'amount' => $amount,
        //         'paymentMethod' => $paymentMethod,
        //         'paymentTax' => $paymentTax,
        //         'conversionTax' => $conversionTax,
        //         'amountWithConversionTax' => $amountWithConversionTax,
        //         'conversionRate' => $conversionRate,
        //         'foreignAmount' => $foreignAmount,
        //     ]));

        // Salvar a cotação realizada na tabela quotations
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

        // Se chegou até aqui, os dados foram validados corretamente e a conversão pode ser realizada
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
            // adicione aqui outros dados relevantes para exibição no resultado
        ]);
    }
}
