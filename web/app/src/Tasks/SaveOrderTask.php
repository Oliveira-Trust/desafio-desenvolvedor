<?php

namespace App\Tasks;

use Exception;
use PaymentModel;
use OrdersModel;
use App\Exceptions\PaymentMethodBuilderException;

class SaveOrderTask
{
    public function run(array $convertData, int $paymentType, int $user): array
    {
        try {
            $payment = (new PaymentModel)->getPaymentByType($paymentType);
            $payment = reset($payment);

            if (empty($payment->label)) {
                throw new PaymentMethodBuilderException();
            }

            $convertData['user_id'] = $user;
            $convertData['payment'] = $payment->label;
            if ((new OrdersModel)->saveOrder($convertData)) {
                return $convertData;
            }

            throw new PaymentMethodBuilderException();
        } catch (Exception $e) {
            log_error($e);
            return [];
        }
    }
}
