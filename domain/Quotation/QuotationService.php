<?php

namespace Oliveiratrust\Quotation;

use Oliveiratrust\CurrencyPrice\CurrencyPriceRepository;
use Oliveiratrust\Fee\FeeRepository;
use Oliveiratrust\Models\FeeType\FeeType;
use Oliveiratrust\Models\Quotation\Quotation;

class QuotationService {

    public function __construct(
        private Quotation $model,
        private CurrencyPriceRepository $priceRepository,
        private FeeRepository $feeRepository
    ){}

    public function quotation(array $data)
    {
        $amount = (float)$data['amount'];

        $currentPrice = $this->priceRepository->getCurrentPrice($data['currency_id']);

        $fees = [
            FeeType::FORMA_DE_PAGAMENTO => $this->feeRepository->getFeeByPaymentType($amount, $data['payment_type_id'])->getCalculedFee(),
            FeeType::TAXAS_DE_CONVERSAO => $this->feeRepository->getFeeByExchange($amount)->getCalculedFee()
        ];

        $fees['total'] = array_sum($fees);

        $quotation = [
            'user_id'           => auth('sanctum')->user()?->id,
            'payment_type_id'   => $data['payment_type_id'],
            'currency_id'       => $data['currency_id'],
            'currency_price_id' => $currentPrice->id,
            'amount'            => $amount,
            'fees'              => $fees,
            'exchanged_amount'  => round(($amount - $fees['total']) / $currentPrice->price, 2),
        ];

        return $this->model->create($quotation);
    }
}
