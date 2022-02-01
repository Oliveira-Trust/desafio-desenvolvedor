<?php

namespace Domain\Purchase\Actions;

use Domain\Fees\Actions\CalculationConversionFeesAction;
use Domain\Fees\Actions\CalculationPaymentFeesAction;
use Domain\Fees\Actions\CalculationTotalFeesAction;
use Domain\PaymentMethod\Repositories\PaymentMethodRepository;
use Domain\Purchase\DataTransferObjects\PurchaseData;
use Domain\Purchase\Events\CreatePurchaseEvent;
use Domain\Purchase\Models\Purchase;
use Domain\User\Models\User;

final class CreatePurchaseAction
{
    private PaymentMethodRepository $paymentMethodRepository;

    private CalculationPaymentFeesAction $calculationPaymentFeesAction;

    private CalculationConversionFeesAction $calculationConversionFees;

    private CalculationTotalFeesAction $calculationTotalFeesAction;

    private CurrencyConvertAction $currencyConvertAction;

    public function __construct(
        PaymentMethodRepository $paymentMethodRepository,
        CalculationPaymentFeesAction $calculationPaymentFeesAction,
        CalculationConversionFeesAction $calculationConversionFees,
        CalculationTotalFeesAction $calculationTotalFeesAction,
        CurrencyConvertAction $currencyConvertAction
    )
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->calculationPaymentFeesAction = $calculationPaymentFeesAction;
        $this->calculationConversionFees = $calculationConversionFees;
        $this->calculationTotalFeesAction = $calculationTotalFeesAction;
        $this->currencyConvertAction = $currencyConvertAction;
    }

    /**
     * @throws \App\Core\Exceptions\HttpException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __invoke(PurchaseData $purchaseData): Purchase
    {
        $combination = [$purchaseData->origin, $purchaseData->destiny];

        $paymentMethod = $this->paymentMethodRepository->findByName($purchaseData->payment_method);

        $paymentFees = ($this->calculationPaymentFeesAction)($paymentMethod->fees, $purchaseData->value);
        $conversionFees = ($this->calculationConversionFees)($purchaseData->value);

        $totalFees = ($this->calculationTotalFeesAction)([$paymentFees, $conversionFees]);

        $purchaseValue = $purchaseData->value - $totalFees;
        $convertedValue = ($this->currencyConvertAction)($combination, $purchaseValue);

        $createdPurchase = new Purchase([
            'origin' => $purchaseData->origin,
            'destiny' => $purchaseData->destiny,
            'quotation_value' => $convertedValue['quotation'],
            'payment_fees' => $paymentFees,
            'conversion_fees' => $conversionFees,
            'request_value' => $purchaseData->value,
            'purchase_value' => $convertedValue['converted'],
        ]);

        $createdPurchase->paymentMethod()->associate($paymentMethod);
        $createdPurchase->user()->associate(auth()->user());

        $createdPurchase->save();

        event(new CreatePurchaseEvent($createdPurchase));

        unset($createdPurchase->payment_method);
        unset($createdPurchase->user);

        return $createdPurchase;
    }
}
