<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'produtos';

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
    protected $fillable = ['nome_prod', 'fab_prod', 'forn_nome', 'forn_contato'];

    
}
