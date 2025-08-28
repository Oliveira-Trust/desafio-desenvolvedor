<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;


class ImportDataFile extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'import_data_files';

    protected $fillable = [
        'upload_file_id',
        'line_number',
        'content',
    ];
}
