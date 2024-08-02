<?php

declare(strict_types=1);

namespace App;

use Module\Broker\Entities\Transaction;
use Module\Broker\Repository\TransactionRepository;

final class FakeTransaction implements TransactionRepository
{
    public function save(Transaction $transaction): void
    {
        $nada = null;
    }
}
