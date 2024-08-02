<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'down',
        'up',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'integer',
            'down' => 'decimal:2',
            'up' => 'decimal:2',
        ];
    }
}
