<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'fee'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::snake(strtolower($value));
    }
}
