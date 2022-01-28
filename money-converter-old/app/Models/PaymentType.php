<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'display_name'];

    public function taxe(): HasOne
    {
        return $this->hasOne(Taxe::class);
    }
}
