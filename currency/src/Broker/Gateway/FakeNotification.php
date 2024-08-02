<?php

declare(strict_types=1);

namespace Module\Broker\Gateway;

use Module\Broker\Entities\Transaction;

final class FakeNotification implements NotificationInterface
{
    public function send(Transaction $transaction): void
    {
        // TODO: Implement send() method.
    }
}
