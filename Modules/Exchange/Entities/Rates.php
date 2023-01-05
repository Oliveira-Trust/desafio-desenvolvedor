<?php

namespace Modules\Exchange\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rates extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bank_slips',
        'credit_card',
        'purchase_price_above',
        'purchase_price_below',
        'purchase_price',
    ];


}
