<?php

namespace App\Models;

use App\Models\ConversionRate;
use App\Models\PaymentMethod;
use App\Support\CurrencyQuoteApi;
use Illuminate\Support\Arr;
use App\Mail\SendConverterResult;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceQuote extends Model
{
    use HasFactory;

    protected $table = 'price_quotes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'payment_method_id',
        'from_currency',
        'to_currency',
        'value',
        'currency_value',
        'purchase_price',
        'payment_rate',
        'conversion_rate',
    ];

    protected $appends = [
        'discounted_value',
        'currency_symbol',
    ];

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function getDiscountedValueAttribute(): float
    {
        return $this->value - $this->conversion_rate - $this->payment_rate;
    }

    public function getCurrencySymbolAttribute(): string|null
    {
        $symbold = [
            'USD' => '$',
            'EUR' => '€',
            'CAD' => '$',
            'JPY' => '¥',
        ];

        return Arr::get($symbold, $this->to_currency);
    }

    public static function getPaymentRate(float $amount, int $payment_method_id): float
    {
        $payment_rate = PaymentMethod::find($payment_method_id);

        return ($payment_rate->fee / 100) * $amount;
    }

    public static function getConversionRate(float $amount): float
    {
        $conversion_rate = ConversionRate::getConversionRate($amount);

        return ($conversion_rate / 100) * $amount;
    }

    public static function getPurchasePrice(float $amount, float $price): float
    {
        return $amount / $price;
    }

    public static function savePriceQuote(array $payload): self|bool
    {
        $currency_quote_client = new CurrencyQuoteApi();
        $currency_value = $currency_quote_client->getCurrencyPrice($payload['currency']);

        if (!$currency_value) {
            return false;
        }
        
        $payment_rate = PriceQuote::getPaymentRate($payload['value'], $payload['payment_method_id']);
        $conversion_rate = PriceQuote::getConversionRate($payload['value']);
        $discounted_value = $payload['value'] - $payment_rate - $conversion_rate;
        $purchased_value = self::getPurchasePrice($discounted_value, $currency_value);

        return PriceQuote::create([
            'user_id' => Auth::user()->id,
            'payment_method_id' => $payload['payment_method_id'],
            'from_currency' => 'BRL',
            'to_currency' => $payload['currency'],
            'value' => $payload['value'],
            'currency_value' => $currency_value,
            'purchase_price' => $purchased_value,
            'payment_rate' => $payment_rate,
            'conversion_rate' => $conversion_rate,
        ]);
    }

    public function sendEmail(): void
    {
        try {
            Mail::to(Auth::user())->send(new SendConverterResult($this));
            alert()->success('Sucesso','E-mail enviado');
        } catch (\Exception $exception) {
            alert()->error('Erro','Configuração de e-mail inválida');
        } 
    }    
}
