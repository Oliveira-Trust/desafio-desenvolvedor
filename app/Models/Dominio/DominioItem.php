<?php

namespace App\Models\Dominio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DominioItem extends Model
{
    use HasFactory;
    protected $table = 'dominios_itens';
    public $primaryKey = 'dominio_id';
    public $incrementing = false;
    protected $fillable = [
        'dominio_id',
        'dsc_dominio_item',
        'val_dominio_item'
    ];

    public function dominio(){
        return $this->belongsTo(Dominio::class, 'dominio_id', 'id');
    }
}
