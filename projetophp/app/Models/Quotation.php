<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'user_id',
        'currency_origin',
        'currency_destination',
        'amount',
        'payment_method',
        'payment_tax',
        'conversion_tax',
        'amount_with_conversion_tax',
        'conversion_rate',
        'foreign_amount',
    ];

    // Se você quiser definir alguma relação ou outros métodos no modelo, pode fazer aqui
}
