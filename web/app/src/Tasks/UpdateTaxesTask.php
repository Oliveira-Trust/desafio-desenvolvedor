<?php

namespace App\Tasks;

use Exception;
use PaymentModel;

class UpdateTaxesTask
{
    public function run(array $data): void
    {
        try {
            (new PaymentModel)->updatePaymentTaxes($data);
        } catch (Exception $e) {
            log_error($e);
        }
    }
}
