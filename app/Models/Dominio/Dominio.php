<?php

namespace App\Models\Dominio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dominio extends Model
{
    use HasFactory;
    protected $table = 'dominios';
    public $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'dsc_dominio'
    ];

    public function dominioItens(){
        return $this->hasMany(DominioItem::class, 'dominio_id', 'id');
    }
}
