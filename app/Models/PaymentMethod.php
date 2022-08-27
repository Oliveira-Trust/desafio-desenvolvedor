<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'fee'
    ];

    public function getTitleFeeAttribute()
    {
        return $this->title . " - taxa de " . number_format(($this->fee * 100), 2, ',', '.') . "%";
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}
