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
        $paramsToConversion = $request->all();
        $paramsToConversion['origin_currency'] = 'BRL'; // especificação do desafio

        return $this->ConversionUseCase->execute($paramsToConversion);
    }


    public function getHistoryByUser($userid)
    {
        $conversions = $this->ConversionUseCase->getConversionHistorybyUserId($userid);

        return $conversions;
    }
}
