<?php

namespace Modules\Fee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'boleto',
        'credit_card',
        'less_than_3000',
        'more_than_3000'
    ];
}
