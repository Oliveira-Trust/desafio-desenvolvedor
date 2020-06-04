<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clientes';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nome_cli', 'email_cli', 'tel_cli', 'aniv_cli'];

    
}
