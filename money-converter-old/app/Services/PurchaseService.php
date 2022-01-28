<?php

namespace App\Services;

use App\Dto\PurchaseDto;
use App\Events\CreatePurchase;
use App\Exceptions\HttpException;
use App\Exceptions\HttpStatus;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PurchaseService
{
    private PaymentTypeService $paymentTypeService;

    private TaxeService $taxeService;

    private ConversionService $conversionService;

    public function __construct(
        PaymentTypeService $paymentTypeService,
        TaxeService        $taxeService,
        ConversionService  $conversionService
    )
    {
        $this->paymentTypeService = $paymentTypeService;
        $this->taxeService = $taxeService;
        $this->conversionService = $conversionService;
    }

    public function getAll()
    {
        return auth()->user()->purchases;
    }

    /**
     * @throws HttpException
     */
    public function create(PurchaseDto $purchaseDto)
    {
        $combination = [$purchaseDto->origin, $purchaseDto->destiny];

        $paymentMethod = $this->paymentTypeService->findByName($purchaseDto->payment_type);

        $paymentTaxe = $this->taxeService->paymentTaxe($paymentMethod->taxe, $purchaseDto->value);
        $conversionTaxe = $this->taxeService->conversionTaxe($purchaseDto->value);

        $totalTaxes = $paymentTaxe + $conversionTaxe;

        $purchaseValueWithTaxes = $purchaseDto->value - $totalTaxes;
        $convertedValue = $this->conversionService->conversionByCombination($combination, $purchaseValueWithTaxes);

        $purchase = new Purchase([
            'origin' => $purchaseDto->origin,
            'destiny' => $purchaseDto->destiny,
            'quotation_value' => $convertedValue['quotation'],
            'payment_taxe' => $paymentTaxe,
            'conversion_taxe' => $conversionTaxe,
            'request_value' => $purchaseDto->value,
            'purchase_value' => $convertedValue['converted'],
        ]);

        $purchase->paymentType()->associate($paymentMethod);
        $purchase->user()->associate(auth('web')->user());

        $purchase->save();

        event(new CreatePurchase($purchase));

        unset($purchase->user);
        unset($purchase->paymentType);

        return response()->json($purchase, HttpStatus::CREATED);
    }
}
