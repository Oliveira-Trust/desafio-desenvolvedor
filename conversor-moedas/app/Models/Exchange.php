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
        'payment_price',
        'conversion_price',
        'conversion_tax',
        'price',
        'value'
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

        $this->conversion_tax = ($baseValue < 3000) ? config('prices.tax.menor_3k') : config('prices.tax.maior_3k');

        $this->payment_price = $baseValue * ($paymentMethod->tax / 100);
        $this->conversion_price = $baseValue * ($this->conversion_tax / 100);

        $this->price = ($baseValue + $this->payment_price + $this->conversion_price);
        $this->value = $baseValue * $conversion->coinPrice->value;

    }
}
