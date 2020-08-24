<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = ['id', 'status','quantity','client_id'];

    public function clientes()
    {
        return $this->belongsTo(Client::class,'client_id', 'id');
    }

    public function itensTransactions()
    {
        return $this->hasMany(ItenTransaction::class,'id', 'client_id');
    }
}
