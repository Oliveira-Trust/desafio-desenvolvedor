<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'currency_from',
        'currency_to',
        'amount',
        'converted_amount',
        'payment_method',
        'payment_method_fee',
        'conversion_fee',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
