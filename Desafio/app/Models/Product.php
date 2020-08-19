<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['id', 'cost','name'];

    public function clientes()
    {
        return $this->hasMany(ItenTransaction::class, 'product_id', 'id');
    }

}
