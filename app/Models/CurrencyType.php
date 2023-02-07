<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyType extends Model
{
    use HasFactory;

    public $tabel="corrency_types";

    protected $fillable = [
        'code',
        'name',
    ];
}
