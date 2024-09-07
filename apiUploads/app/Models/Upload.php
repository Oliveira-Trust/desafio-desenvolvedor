<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;
    protected $table = 'uploads';

    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'rptDt',
        'tckrSymb',
        'mktNm',
        'sctyCtgyNm',
        'iSIN',
        'crpnNm'
    ];

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];

   
}
