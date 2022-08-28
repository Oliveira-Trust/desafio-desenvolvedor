<?php

namespace App\Http\Services;

use App\Models\ConversionFee;
use App\Models\PaymentMethod;
use App\Models\SourceCurrency;
use App\Models\TargetCurrency;
use Illuminate\Support\Facades\Http;

class CurrencyApiService
{
    protected const API_BASE_URL = "https://economia.awesomeapi.com.br/json/last/";


    /**
     * Pega as informações de cotação inseridas pelo usuário e devolve as cotação atualizada
     * @param array $data
     * @return ?array
     */
    public static function getUpdatedQuotationValues(array $data): ?array
    {
        $sourceCurrency = SourceCurrency::find($data['source_currency_id']);
        $sourceCurrencyAcronym = $sourceCurrency->acronym;
        $sourceCurrencySymbol = $sourceCurrency->symbol;

        $targetCurrency = TargetCurrency::find($data['target_currency_id']);
        $targetCurrencyAcronym = $targetCurrency->acronym;
        $targetCurrencySymbol = $targetCurrency->symbol;


        $currentApiQuotation = \App\Http\Services\CurrencyApiService::currentQuotationForCurrencies($sourceCurrencyAcronym, $targetCurrencyAcronym);

        if (!$currentApiQuotation) {
            return null;
        }

        $paymentMethod = PaymentMethod::find($data['payment_method_id']);
        $paymentMethodFee = $paymentMethod->fee;

        $conversionFees = ConversionFee::all();

        $conversionFeePercentage = "";
        $conversionFeeAmount = "";

        foreach ($conversionFees as $key => $value) {
            $comparison = eval("return \$data['source_amount'] {$value->conversionFeeMathOperator->symbol} \$value->fee_relative_amount;"); // Para saber a taxa de conversão pelo valor - retorna Ex.: 5000 < 3000 (false), 6000 > 2000 (true)...

            if ($comparison) {
                $conversionFeePercentage = $value->fee;
                $conversionFeeAmount = $data['source_amount'] * ($value->fee / 100);
            }
        }

        unset($data['source_currency_id']);
        unset($data['target_currency_id']);
        
        $data['source_currency_acronym'] = $sourceCurrencyAcronym;
        $data['source_currency_symbol'] = $sourceCurrencySymbol;
        $data['target_currency_acronym'] = $targetCurrencyAcronym;
        $data['target_currency_symbol'] = $targetCurrencySymbol;
        $data['target_currency_quote'] = number_format($currentApiQuotation->bid, 2);
        $data['payment_method'] = $paymentMethod->title;
        $data['payment_method_fee_percentage'] = $paymentMethodFee;
        $data['payment_method_fee_amount'] = $data['source_amount'] * ($paymentMethodFee / 100);
        $data['conversion_fee_percentage'] = $conversionFeePercentage ?? 0;
        $data['conversion_fee_amount'] = $conversionFeeAmount ?? 0;
        $data['source_taxed_amount'] = $data['source_amount'] - ($data['conversion_fee_amount'] + $data['payment_method_fee_amount']);
        $data['target_amount'] = number_format($data['source_taxed_amount'] / $data['target_currency_quote'], 2, '.', '');
        $data['user_id'] = auth()->user()->id;

        return $data;
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
