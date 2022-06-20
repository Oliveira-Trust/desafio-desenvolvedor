<?php

namespace Oliveiratrust\Fee;

use Illuminate\Database\Eloquent\Collection;
use Oliveiratrust\Models\Fee\Fee;
use Oliveiratrust\Models\FeeType\FeeType;

class FeeRepository {

    private       $fee;
    private float $amount;

    public function __construct(
        private Fee $model,
    ){}

    public function list(): Collection
    {
        return $this->model->with('feeType', 'paymentType')
                           ->orderBy('fee_type_id')
                           ->orderBy('payment_type_id')
                           ->orderBy('min_amount')
                           ->get();
    }

    public function getFeeByPaymentType(float $amount, int $payment_type_id): FeeRepository
    {
        $this->amount = $amount;

        $this->fee = $this->model->where('fee_type_id', FeeType::FORMA_DE_PAGAMENTO)
                                 ->where('payment_type_id', $payment_type_id)
                                 ->where('min_amount', '<=', $amount)
                                 ->where('max_amount', '>=', $amount)
                                 ->first();

        return $this;
    }

    public function getFeeByExchange(float $amount): FeeRepository
    {
        $this->amount = $amount;

        $this->fee = $this->model->where('fee_type_id', FeeType::TAXAS_DE_CONVERSAO)
                                 ->where('min_amount', '<=', $amount)
                                 ->where('max_amount', '>=', $amount)
                                 ->first();

        return $this;
    }

    public function getCalculedFee(): float
    {
        if ( ! $this->fee) {
            return 0.00;
        }

        return ($this->amount / 100 * $this->fee->percent) + $this->fee->fixed_value;
    }
}
