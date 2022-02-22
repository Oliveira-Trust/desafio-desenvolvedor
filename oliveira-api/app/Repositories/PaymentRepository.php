<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Abstracts\AbstractBaseRepository as BaseRepository;

class PaymentRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Payment::class);
    }
}
