<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_item extends Model
{
    use HasFactory;
    protected $fillable = ['id_pedido','id_item','quantidade','valor_item','desconto']; 
}
