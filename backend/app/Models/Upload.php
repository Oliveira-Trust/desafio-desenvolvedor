<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    // Coleção no MongoDB
    protected string $collection = 'uploads';

    // Definindo os campos que podem ser preenchidos
    protected $fillable = [
        'name',
        'hash',
        'path',
        'uploaded_at'
    ];

    // Definindo o campo de data de maneira automática
    protected array $dates = ['uploaded_at'];

    public function contents(): \Illuminate\Database\Eloquent\Relations\HasMany|\MongoDB\Laravel\Relations\HasMany
    {
        return $this->hasMany(FileContent::class);
    }
}
