<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Upload extends Model
{
    protected $collection = 'uploads';
    protected $connection = 'mongodb';

    protected $fillable = [
        'original_name',
        'stored_name',
        'hash',
        'reference_date',
    ];
}
