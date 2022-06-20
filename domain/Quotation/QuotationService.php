<?php

namespace Oliveiratrust\Quotation;

use App\Mail\SendQuotationMail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use Oliveiratrust\CurrencyPrice\CurrencyPriceRepository;
use Oliveiratrust\Fee\FeeRepository;
use Oliveiratrust\Models\FeeType\FeeType;
use Oliveiratrust\Models\Quotation\Quotation;

class QuotationService {

    use AuthorizesRequests;

    public function __construct(
        private Quotation               $model,
        private CurrencyPriceRepository $priceRepository,
        private FeeRepository           $feeRepository
    ){}

    public function quotation(array $data)
    {
        $amount = (float)$data['amount'];

        $currentPrice = $this->priceRepository->getCurrentPrice($data['currency_id']);

        $fees = [
            FeeType::FORMA_DE_PAGAMENTO => round($this->feeRepository->getFeeByPaymentType($amount, $data['payment_type_id'])->getCalculedFee(), 2),
            FeeType::TAXAS_DE_CONVERSAO => round($this->feeRepository->getFeeByExchange($amount)->getCalculedFee(), 2)
        ];

        $fees['total'] = array_sum($fees);

        $quotation = [
            'user_id'           => auth()->user()->id,
            'payment_type_id'   => $data['payment_type_id'],
            'currency_id'       => $data['currency_id'],
            'currency_price_id' => $currentPrice->id,
            'amount'            => $amount,
            'price'             => $currentPrice->price,
            'fees'              => $fees,
            'exchanged_amount'  => round(($amount - $fees['total']) / $currentPrice->price, 2),
        ];

        return $this->model->create($quotation);
    }

    public function sendEmail(int $id): bool
    {
        $quotation = $this->model->where('id', $id)
                                 ->first();

        $this->authorize('show', $quotation);

        Mail::to(auth()->user()->email)->send(new SendQuotationMail($quotation));

        return true;
    }
}
