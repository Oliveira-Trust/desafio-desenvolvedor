<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forma extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'percentual',
    ];

    public function historico()
    {
        return $this->belongsToMany(Historico::class);
    }
}
