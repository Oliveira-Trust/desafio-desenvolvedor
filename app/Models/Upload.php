<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'uploaded_at'];

    public function fileContents()
    {
        return $this->hasMany(FileContent::class);
    }
}
