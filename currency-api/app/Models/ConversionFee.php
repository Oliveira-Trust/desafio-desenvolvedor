<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'lower_than_threshold',
        'greater_than_threshold',
        'amount_threshold',
        'active'
    ];

    protected $casts = [
        'lower_than_threshold' => 'float',
        'greater_than_threshold' => 'float',
        'amount_threshold' => 'float',
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
