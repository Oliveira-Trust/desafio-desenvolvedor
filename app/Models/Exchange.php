<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency',
        'method',
        'ammount',
        'ammount_fee',
        'method_fee',
        'net_ammount',
        'exchange_rate',
        'converted_ammount',
    ];

    protected $casts = [
        'currency' => 'string',
        'method' => 'string',
        'ammount' => 'float',
        'ammount_fee' => 'float',
        'method_fee' => 'float',
        'net_ammount' => 'float',
        'exchange_rate' => 'float',
        'converted_ammount' => 'float',
    ];

    protected static function booted()
    {
        static::creating(function ($exchange) {
            $exchange->user_id = Auth::user()->id;
        });
    }

}
