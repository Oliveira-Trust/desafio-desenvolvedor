<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = ['id', 'status','client_id'];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class,'id', 'client_id');
    }

    public function itensTransactions()
    {
        return $this->hasMany(ItenTransaction::class,'id', 'client_id');
    }
}
