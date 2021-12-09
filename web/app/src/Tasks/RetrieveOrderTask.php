<?php

namespace App\Tasks;

use Exception;
use OrdersModel;

class RetrieveOrderTask
{
    public function run(int $userId): array
    {
        try {
            return (new OrdersModel)->findOrder($userId);
        } catch (Exception $e) {
            log_error($e);
            return [];
        }
    }
}
