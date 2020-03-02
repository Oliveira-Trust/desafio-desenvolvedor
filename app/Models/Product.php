<?php

namespace App\Models;

use App\Models\Traits\ByUser;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ByUser;

    protected $fillable = [
        'name',
        'brand',
        'price'
    ];
}
