<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConversionRequest;
use App\Http\Application\UseCases\ConversionUseCase;

class ConversionController extends Controller
{
    private ConversionUseCase $ConversionUseCase;

    public function __construct(ConversionUseCase $ConversionUseCase)
    {
        $this->ConversionUseCase = $ConversionUseCase;
    }
    public function convert(ConversionRequest $request)
    {
        $paramsToConversion = [
            'origin_currency' => 'BLR',
            'destination_currency' => $request->input('destination_currency'),
            'conversion_value' => $request->input('conversion_value'),
            'payment_method_id' => $request->input('payment_method_id'),

        ];

        return $this->ConversionUseCase->execute($paramsToConversion);
    }


    public function getHistoryByUser($userid)
    {

        $conversions = $this->ConversionUseCase->getConversionHistorybyUserId($userid);

        return $conversions;
    }
}
