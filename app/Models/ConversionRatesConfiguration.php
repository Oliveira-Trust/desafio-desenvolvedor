<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionRatesConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method',
        'payment_method_fee',
        'conversion_fee_threshold',
        'conversion_fee_below_threshold',
        'conversion_fee_above_threshold',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
