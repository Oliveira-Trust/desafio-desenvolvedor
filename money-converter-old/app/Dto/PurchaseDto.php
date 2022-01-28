<?php

namespace App\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class PurchaseDto extends DataTransferObject
{
    public $origin;

    public $destiny;

    public $value;

    public $payment_type;
}
