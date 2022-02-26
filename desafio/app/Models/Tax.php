<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $table = 'fees';

    protected $fillable = [
        'tax',
        'payment_method_id'
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
