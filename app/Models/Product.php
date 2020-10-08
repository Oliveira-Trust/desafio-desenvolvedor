<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'price'];


    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
