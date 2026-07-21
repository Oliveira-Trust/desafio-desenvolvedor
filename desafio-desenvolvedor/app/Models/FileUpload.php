<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $fillable = [
        'file_name',
        'file_hash',
        'status',
        'error_message',
    ];
}
