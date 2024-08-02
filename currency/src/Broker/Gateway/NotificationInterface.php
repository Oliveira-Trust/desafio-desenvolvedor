<?php

namespace Module\Broker\Gateway;

use Module\Broker\Entities\Transaction;

interface NotificationInterface
{
    public function send(Transaction $transaction): void;
}
