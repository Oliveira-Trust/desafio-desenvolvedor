<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'hash',
        'uploaded_at',
        'uploaded_by',
    ];

    public function instruments()
    {
        return $this->hasMany(Instrument::class);
    }
}