<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $fillable = [
        'path',
        'original_name',
        'user_id',
        'rows_expected',
        'rows_processed',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
