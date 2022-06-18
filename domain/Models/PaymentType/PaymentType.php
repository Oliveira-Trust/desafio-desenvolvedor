<?php

namespace Oliveiratrust\Models\PaymentType;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model {

    protected $fillable = ['description'];

    const BOLETO            = 1;
    const CARTAO_DE_CREDITO = 2;

}
