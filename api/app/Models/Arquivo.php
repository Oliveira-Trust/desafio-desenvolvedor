<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'arquivos';
    protected $primaryKey = '_id';
}
