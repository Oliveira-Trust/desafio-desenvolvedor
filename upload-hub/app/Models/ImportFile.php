<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;


class ImportFile extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'import_files';

    protected $fillable = [
        'nome',
        'email',
    ];
}
