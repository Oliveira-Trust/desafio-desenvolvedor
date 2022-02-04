<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HExchange extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cur_origim',
        'cur_destiny',
        'val_input',
        'mhd_payment',
        'val_cur_destiny',
        'val_buy',
        'rate_payment',
        'rate_conversion',
        'discont_onversion'
    ];
}
