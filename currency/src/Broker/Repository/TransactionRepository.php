<?php

namespace Module\Broker\Repository;

use Module\Broker\Entities\Transaction;

interface TransactionRepository
{
    public function save(Transaction $transaction): void;
}
