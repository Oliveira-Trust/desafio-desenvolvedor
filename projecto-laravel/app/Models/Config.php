<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    // For implement after; Currently has default configs to test in migrations
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'payment_methods',
        'fee_level_one',
        'fee_limit_level_one',
        'fee_level_two',
        'fee_limit_level_two',
        'active_currency',
        'max_value_convertion',
    ];

}
