<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConvertedValue extends Model
{
    use SoftDeletes;

    protected $date = ['deleted_at'];
    protected $fillable = [
        'origin_value',
        'origin_currency',
        'converted_value',
        'converted_currency',
        'payment_method',
        'tenant_id',
        'tax_conversion',
        'tax_payment_method',
        'tax_currency',
        'updated_value',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
