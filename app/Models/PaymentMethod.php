<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'enabled',
        'tax_rate',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function conversions(): HasMany
    {
        return $this->hasMany(Conversion::class);
    }
}
