<?php

namespace Oliveiratrust\Models\FeeType;

use Illuminate\Database\Eloquent\Model;
use Oliveiratrust\Models\Fee\Fee;

class FeeType extends Model {

    protected $fillable = ['description'];

    const FORMA_DE_PAGAMENTO = 1;
    const TAXAS_DE_CONVERSAO = 2;

}
