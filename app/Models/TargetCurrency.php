<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetCurrency extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
        'acronym',
        'description',
    ];

    public function getAcronymDescriptionAttribute()
    {
        return $this->acronym . " - " . $this->description;
    }
}
