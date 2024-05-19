<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'is_enabled'
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    public function conversions(): HasMany
    {
        return $this->hasMany(Conversion::class);
    }

    public function tax(): HasOne
    {
        return $this->hasOne(Tax::class);
    }

    public function scopeEnabled($query)
    {
        return $query->where('is_enabled', true);
    }
}
