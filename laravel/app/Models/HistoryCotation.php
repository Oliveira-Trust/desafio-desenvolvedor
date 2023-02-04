<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryCotation extends Model
{
    use HasFactory;

    protected $table = 'cotations_history';

    protected $fillable = [
        'user_id',
        'currency_origin',
        'currency_buy',
        'amount',
        'currency_value',
        'payment_type',
        'value_bought',
        'payment_tax',
        'conversion_tax',
        'conversion_value'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdAt()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y H:i:s');
    }

    public static function returnPaymentType(string $paymentType){
       return match ($paymentType) {
            "boleto" => "Boleto",
            "credit_card" => "Cartão de Crédito",
            default => '0'
        };
    }
}

