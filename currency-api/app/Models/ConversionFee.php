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
        'effective_date'
    ];

    protected $casts = [
        'lower_than_threshold' => 'float',
        'greater_than_threshold' => 'float',
        'amount_threshold' => 'float',
        'effective_date' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($model) {
            $model->effective_date = now();
        });
    }

    /**
     * Get the active conversion fee.
     *
     * @return ConversionFee|null
     */
    public static function getActive(): ?self
    {
        return self::orderBy('effective_date', 'desc')->first();
    }
}
