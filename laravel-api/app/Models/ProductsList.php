<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ProductsList extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products_list';
    public $timestamps = false;

    protected $guarded = [];
}
