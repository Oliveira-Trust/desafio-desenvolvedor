<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'target_currency_quote',
        'source_amount',
        'payment_method_fee_amount',
        'conversion_fee_amount',
        'source_taxed_amount',
        'target_amount',
        'payment_status',
        'source_currency_id',
        'target_currency_id',
        'user_id',
        'payment_method_id',
        'conversion_fee_id',
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conversionFee()
    {
        return $this->belongsTo(ConversionFee::class);
    }

    public function sourceCurrency()
    {
        return $this->belongsTo(Currency::class, 'source_currency_id', 'id');
    }

    public function targetCurrency()
    {
        return $this->belongsTo(Currency::class, 'target_currency_id', 'id');
    }

    /**
     * Pega as informações escolhidas pelo usuário e faz a cotação
     */
    public static function getUpdatedQuotationValues(array $data): ?array
    {
        $sourceCurrency = Currency::find($data['source_currency_id'])->acronym;
        $targetCurrency = Currency::find($data['target_currency_id'])->acronym;

        $quotation = \App\Http\Services\CurrencyApiService::currentQuoteForCurrency($sourceCurrency, $targetCurrency);

        if (!$quotation) {
            return null;
        }
        
        $data['user_id'] = auth()->user()->id;
        $data['target_currency_quote'] = number_format($quotation->bid, 2);

        $paymentMethodFee = PaymentMethod::find($data['payment_method_id'])->fee;
        $conversionFees = ConversionFee::all();

        foreach ($conversionFees as $key => $value) {
            $comparison = eval("return \$data['source_amount'] {$value->conversionFeeMathOperator->symbol} \$value->begin_amount;"); // Para saber a taxa de conversão pelo valor - retorna Ex.: 5000 < 3000 (false), 6000 > 2000 (true)...

            if ($comparison) {
                $data['conversion_fee_id'] = $value->id;
                $data['conversion_fee_amount'] = $data['source_amount'] * $value->percentage;
                break;
            }
        }
        
        $data['payment_method_fee_amount'] = $data['source_amount'] * $paymentMethodFee;
        $data['source_taxed_amount'] = $data['source_amount'] - ($data['conversion_fee_amount'] + $data['payment_method_fee_amount']);
    
        $targetAmount = $data['source_taxed_amount'] / $data['target_currency_quote'];
        $data['target_amount'] = number_format($targetAmount, 2, '.', '');

        return $data;
    }
}
