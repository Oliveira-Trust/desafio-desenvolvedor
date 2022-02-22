<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Abstracts\AbstractBaseService as BaseService;

class PaymentService extends BaseService
{
    public function __construct(PaymentRepository $paymentRepository)
    {
        parent::__construct($paymentRepository);
    }
}
