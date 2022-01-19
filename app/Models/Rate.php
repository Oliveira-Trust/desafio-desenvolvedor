<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';
    protected $primaryKey = 'id';
    protected $fillable = [
        'min_amount',
        'max_amount',
        'target_amount',
        'rate_min',
        'rate_max',
        'rate_bankslips',
        'rate_credit_card', 
    ];
}
