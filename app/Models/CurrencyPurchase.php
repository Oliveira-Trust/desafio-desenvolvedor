<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CurrencyPurchase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'origin_currency',
        'origin_currency_value',
        'destination_currency_id',
        'converted_currency_value',
        'destination_currency_price',
        'convertion_fee',
        'convertion_fee_value',
        'payment_fee',
        'payment_fee_value',
        'payment_type_id',
        'user_id'
    ];

    protected $date = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'origin_currency_value' => 'decimal:2',
        'converted_currency_value' => 'decimal:2',
        'destination_currency_price' => 'decimal:2',
        'convertion_fee' => 'decimal:2',
        'convertion_fee_value' => 'decimal:2',
        'payment_fee' => 'decimal:2',
        'payment_fee_value' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destinationCurrency()
    {
        return $this->belongsTo(Currency::class, 'destination_currency_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function scopeSearch($query, array $data = [])
    {

        $query->with([
            'paymentType',
            'destinationCurrency',
            'user'
        ]);
        $query->orderBy('id', 'desc');
        return $query;
    }

}
