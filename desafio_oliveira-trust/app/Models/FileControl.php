<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class FileControl extends Model
{
    use HasFactory;

    const STATUS_CREATED    = 'Arquivo esta processando';
    const STATUS_FINISH     = 'Arquivo processado';

}
