<?php

namespace App\Actions;

use Exception;
use Selene\Request\Request;
use App\Traits\ConvertRequestTrait;
use App\Tasks\RetrieveOrderTask;
use App\Exceptions\OrdersGeneralException;

class OrdersAction
{
    use ConvertRequestTrait;

    public function run(Request $request): array
    {
        try {
            $data = $request->sanitize([
                'user_id'
            ]);

            if (empty($data)) {
                throw new OrdersGeneralException();
            }

            $userId = (float) $data['user_id'] ?? null;

            return (new RetrieveOrderTask)->run($userId);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
