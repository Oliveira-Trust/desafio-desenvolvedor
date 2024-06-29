<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee
{
    use HasFactory;

    protected $table = 'fee';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'value',
        'percent',
        'application'
    ];

}
