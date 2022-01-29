<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesSetup extends Model
{
    use HasFactory;
    
    protected $table = 'fees_setup';

    protected $fillable = [
        'fee_1',
        'fee_2',
    ];

}
