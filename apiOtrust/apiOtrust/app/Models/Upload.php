<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Upload extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'uploaded_files';

    protected $filltable =[
        'file_name',
        'upload_date',
        'data'
    ];
}
