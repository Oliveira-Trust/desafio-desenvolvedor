<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'original_name',
        'file_name',
        'file_path',
        'file_hash',
        'status',
        'reference_date',
        'processed_at',
        'total_records',
        'error_message',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'reference_date' => 'date',
        'processed_at' => 'datetime',
        'total_records' => 'integer',
    ];
} 