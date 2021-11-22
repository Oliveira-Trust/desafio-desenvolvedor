<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormaPagamentoModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'forma_pagamento';
    protected $fillable = ['id', 'nome', 'taxa', 'id_user', 'created_at', 'updated_at', 'deleted_at'];
}
