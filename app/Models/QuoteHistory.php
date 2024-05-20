<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class QuoteHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'origin_currency',
        'destination_currency',
        'payment_method',
        'original_amount',
        'converted_amount',
        'exchange_rate',
        'tax_rate_value',
        'tax_rate_value_porcentages',
        'tax_conversion_value',
        'tax_conversion_percentage',
        'tax_total',
        'original_value_minus_tax',
        'email_sent_at',
    ];

    protected $casts = [
        'email_sent_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
