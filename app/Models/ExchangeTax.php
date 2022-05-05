<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeTax extends Model
{
    use HasFactory;

    public function tax()
    {
      return $this->belongsTo(\App\Models\Tax::class, 'tax_id');
    } 

    public function scopeGetTax($query, $value)
    {
        $query->where('from', '<=', $value)->where('to', '>=', $value);
    }
}
