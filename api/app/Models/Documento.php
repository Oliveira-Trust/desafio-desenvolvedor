<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\DocumentModel;

class Documento extends Model
{
    use DocumentModel, HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'documentos';
    protected $keyType = 'string';
    protected $primaryKey = '_id';
}
