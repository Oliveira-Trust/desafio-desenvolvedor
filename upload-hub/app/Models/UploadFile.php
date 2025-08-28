<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    protected $fillable = [
        'path',
        'original_name',
        'user_id',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            0 => 'Pending',
            1 => 'Processing',
            2 => 'Completed',
            3 => 'Failed',
            default => 'Pending',
        };
    }
}
