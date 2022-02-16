<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modeas extends Model
{
    use HasFactory;

    protected $fillable = [
        "moeda",
        "code",
        "codein",
        "name",
        "high",
        "low",
        "varBid",
        "pctChange",
        "bid",
        "ask",
        "timestamp",
        "create_date",
    ];
}
