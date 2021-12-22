<?php

namespace Converter\Repositories;

use App\Repositories\Repository;
use Converter\Models\Payment;

class PaymentRepository extends Repository
{
    public function __construct(
        protected Payment $model
    )
    {
        
    }    
}