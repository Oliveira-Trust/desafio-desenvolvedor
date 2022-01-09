<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class QuotationHistory extends Model
{
    use Notifiable;

    protected $fillable = [
        'currency_from', 'currency_to', 'payment_type', 'name', 'bid', 'create_date', 'quote_value'
    ];
}
