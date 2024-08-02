<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property string $label
 */
class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'tax',
        'active',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'tax' => 'decimal:2',
            'active' => 'boolean',
        ];
    }

    protected function label(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::upper($value),
        );
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }
}
