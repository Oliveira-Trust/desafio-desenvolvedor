<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_name',
        'file_hash',
        'reference_date',
        'total_rows',
        'status'
    ];

    protected $casts = [
        'reference_date' => 'string'
    ];

    protected $hidden = [
        'file_hash'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instruments()
    {
        return $this->hasMany(Instrument::class);
    }

}
