<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ItenTransaction;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['id', 'cost','name'];

    public function transactions()
    {
        return $this->hasMany(ItenTransaction::class, 'product_id', 'id');
    }

}
