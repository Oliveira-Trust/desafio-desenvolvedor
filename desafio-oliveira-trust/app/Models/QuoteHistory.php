<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteHistory extends Model
{
    use HasFactory;
    protected $table = 'exchange_histories';
    protected $fillable = [
        'user_id',
        'destination_currency',
        'amount',
        'conversion_rate',
        'converted_amount',
        'payment_fee',
        'conversion_fee',
        'net_amount',
        'payment_method',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
