<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversion_id',
        'user_id',
        'payment_method_id',
        'value',
        'price'
    ];

    public function conversion(): BelongsTo
    {
        return $this->belongsTo(Conversion::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function calculatePriceForSaving(): void
    {
        $paymentMethod = PaymentMethod::find($this->payment_method_id);
        $conversion = Conversion::with('coinPrice')->find($this->conversion_id);

        $baseValue = $conversion->value;
        $transactionTax = ($baseValue < 3000) ? config('prices.tax.menor_3k') : config('prices.tax.maior_3k');

        $paymentMethodPrice = $baseValue * ($paymentMethod->tax / 100);
        $transactionPrice = $baseValue * ($transactionTax / 100);

        $this->value = $baseValue * $conversion->coinPrice->value;
        $this->price = ($baseValue + $paymentMethodPrice + $transactionPrice);

    }
}
