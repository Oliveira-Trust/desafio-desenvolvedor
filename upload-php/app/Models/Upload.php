<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'hash',
        'path',
        'uploaded_by',
        'status',
        'user_id',
    ];

    public function instruments()
    {
        return $this->hasMany(Instrument::class);
    }
}
