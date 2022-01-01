<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserConversion extends Model
{
    use HasFactory;

    public const PERCENT_TICKET = 1.45;

    public const PERCENT_CREDIT_CARD = 7.63;

    public const VALUE_CONVERSION = 3000.00;

    public const PAYMENT_TICKET = 'ticket';

    public const PAYMENT_CREDIT_CARD = 'credit_card';

    public const USD = 'USD';

    public const EUR = 'EUR';

    protected $table = 'user_conversions';

    protected $fillable = [
        'user_id',
        'currency_origin',
        'currency_destiny',
        'value',
        'payment_method'
    ];

    public function conversionResponses() : HasOne
    {
        return $this->hasOne(UserConversionResponse::class, 'user_conversion_id');
    }

    public static function getCurrencyQuote(string $currency_origin, $currency_destiny) : object
    {
        $currencyType = $currency_origin . '-' . $currency_destiny;

        $conversion = new \GuzzleHttp\Client();

        $url = 'https://economia.awesomeapi.com.br/json/last/' . $currencyType;

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = $conversion->request('GET', $url, ['headers' => $headers]);

        $result = json_decode($response->getBody());

        return $result;
    }
}
