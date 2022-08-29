<?php

namespace App\Http\Services;

use App\Models\ConversionFee;
use App\Models\PaymentMethod;
use App\Models\SourceCurrency;
use App\Models\TargetCurrency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;

class ExchangeApiService
{
    protected const API_BASE_URL = "https://economia.awesomeapi.com.br/json/last/";


    /**
     * Pega as informações de cotação inseridas pelo usuário e devolve as cotação atualizada
     * @param array $data
     * @return ?array
     */
    public static function getUpdatedQuotationValues(array $data): ?array
    {
        // Informações da moeda de origem
        $sourceCurrency = SourceCurrency::find($data['source_currency_id']);
        $sourceCurrencyAcronym = $sourceCurrency->acronym;
        $sourceCurrencySymbol = $sourceCurrency->symbol;

        // Informações da moeda de destino
        $targetCurrency = TargetCurrency::find($data['target_currency_id']);
        $targetCurrencyAcronym = $targetCurrency->acronym;
        $targetCurrencySymbol = $targetCurrency->symbol;

        // Informações da forma de pagamento
        $paymentMethod = PaymentMethod::find($data['payment_method_id']);
        $paymentMethodFee = $paymentMethod->fee;
        $paymentMethodTitle = $paymentMethod->title;

        // Consulta a cotação atualizada na API 
        $currentApiQuotation = self::currentQuotationForCurrencies($sourceCurrencyAcronym, $targetCurrencyAcronym);

        // Retorna null se houver erros na consulta à API
        if (!$currentApiQuotation) {
            return null;
        }
        
        // Lista as taxas de conversão configuradas no sistema (Em order de valores)
        $conversionFees = ConversionFee::query()
                ->orderBy('fee_relative_amount')
                ->get();
                
        // Aplica uma das taxas de conversão configuradas no sistema
        $conversionFee = self::applyConversionFee($conversionFees, $data['source_amount']);

        $data['source_currency_acronym'] = $sourceCurrencyAcronym; // Moeda de origem
        $data['source_currency_symbol'] = $sourceCurrencySymbol; // Moeda de origem (Símbolo)
        $data['target_currency_acronym'] = $targetCurrencyAcronym; // Moeda de destino
        $data['target_currency_symbol'] = $targetCurrencySymbol; // Moeda de destino (Símbolo)
        $data['target_currency_quote'] = number_format($currentApiQuotation->bid, 2); // Valor da "moeda de destino" utilizado para conversão
        $data['payment_method'] = $paymentMethodTitle; // Forma de pagamento
        $data['payment_method_fee_percentage'] = $paymentMethodFee; // Porcentagem da taxa da forma de pagamento
        $data['payment_method_fee_amount'] = $data['source_amount'] * ($paymentMethodFee / 100); // Valor da taxa da forma de pagamento
        $data['conversion_fee_percentage'] =  $conversionFee['fee'] ?? 0; // Porcentagem da taxa de conversão
        $data['conversion_fee_amount'] = $conversionFee['amount'] ?? 0; // Valor da taxa de conversão
        $data['source_taxed_amount'] = $data['source_amount'] - ($data['conversion_fee_amount'] + $data['payment_method_fee_amount']); // Valor utilizado para conversão (com as taxas)
        $data['target_amount'] = number_format($data['source_taxed_amount'] / $data['target_currency_quote'], 2, '.', ''); // Valor comprado em "Moeda de destino"
        $data['user_id'] = auth()->user()->id; // Usuário que fez a cotação

        return $data;
    }

    protected static function applyConversionFee(Collection $conversionFees, string | float $sourceAmount): array
    {
        $conversionFeePercentage = ""; // Taxa
        $conversionFeeAmount = ""; // Valor
        foreach ($conversionFees as $key => $value) {
            // Ex.: < (menor que)
            // Ex.: >= (menor ou igual a)
            $symbol = $value->conversionFeeMathOperator->symbol;

            // Ex.: 5000 < 3000 (false),
            // Ex.: 6000 > 2000 (true)
            $test = eval("return \$sourceAmount $symbol \$value->fee_relative_amount;");
            
            if ($test) {
                $conversionFeePercentage = $value->fee; // Retorna a taxa configurada
                $conversionFeeAmount = $sourceAmount * ($value->fee / 100); // Aplica ao valor a taxa configurada
            }
        }

        return [
            'fee' => $conversionFeePercentage,
            'amount' => $conversionFeeAmount
        ];
    }

    protected static function currentQuotationForCurrencies(string $sourceCurrencyAcronym, string $targetCurrencyAcronym): object | null
    {
        $endPoint = self::API_BASE_URL . "{$targetCurrencyAcronym}-{$sourceCurrencyAcronym}";

        $response = Http::get($endPoint);

        if ($response->status() !== 200) {
            return null;
        }

        return $response
            ->object()
            ->{"{$targetCurrencyAcronym}{$sourceCurrencyAcronym}"};
    }
}
