<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Upload extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'uploads';

    protected $fillable = [
        'filename',
        'original_name',
        'size',
        'hash',
        'reference_date',
        'rows_imported',
        'status',
    ];

    protected $casts = [
        'reference_date' => 'datetime',
        'created_at'     => 'datetime',
    ];
}
