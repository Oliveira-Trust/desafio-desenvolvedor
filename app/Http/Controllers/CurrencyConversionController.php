<?php

namespace App\Http\Controllers;

use App\Dtos\CurrencyConversionDto;
use App\Enum\CurrencyEnum;
use App\Enum\PaymentMethodEnum;
use App\Http\Requests\CurrencyConversionRequest;
use App\Http\Resources\CurrencyConversionResource;
use App\UseCases\CurrencyConversion\CurrencyConversionUseCase;
use Illuminate\Support\Arr;

/**
 * @group Currency Conversion
 */
class CurrencyConversionController extends Controller
{
    public function __construct(
        protected CurrencyConversionUseCase $currencyConversionUseCase,
    ) {
    }

    /**
     * Convert origin currency to target currency.
     *
     * This endpoint allows you to convert a currency and fetch its related taxes.
     * @responseFile storage/responses/currency-conversion.post.json
     */
    public function convert(CurrencyConversionRequest $request): CurrencyConversionResource
    {
        $dto = new CurrencyConversionDto(
            origin: CurrencyEnum::BRL,
            target: $request->enum('target', CurrencyEnum::class),
            conversionValue: $request->input('conversion_value'),
            paymentMethod: $request->enum('payment_method', PaymentMethodEnum::class),
        );

        $batch = [$dto];
        $batch = $this->currencyConversionUseCase->execute($batch);
        $dto = Arr::first($batch);

        return CurrencyConversionResource::make($dto);
    }
}
