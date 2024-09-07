<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadsContents extends Model
{
    protected $table = 'uploads_contents';

    protected $fillable = [
        'upload_id',
        'rptDt',
        'tckrSymb',
        'mktNm',
        'sctyCtgyNm',
        'iSIN',
        'crpnNm'
    ];

    public function upload()
    {
        return $this->belongsTo(Upload::class, 'upload_id');
    }
}
