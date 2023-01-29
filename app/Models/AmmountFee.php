<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmmountFee extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['ammount', 'fee'];

    protected $casts = [
        'ammount' => 'float',
        'fee' => 'float'
    ];
}
