<?php

namespace Domain\Purchase\Events;

use Domain\Purchase\Models\Purchase;
use Illuminate\Queue\SerializesModels;

class CreatePurchaseEvent
{
    use SerializesModels;

    public Purchase $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function purchase(): Purchase
    {
        return $this->purchase;
    }
}
