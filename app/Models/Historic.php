<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    use HasFactory;

    public $table = "historical";

    protected $fillable = [
        'user_id',
        'details',
    ];

}
