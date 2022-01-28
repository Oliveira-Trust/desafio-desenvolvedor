<?php

namespace App\Services;

use App\Models\Taxe;
use Illuminate\Http\JsonResponse;

class TaxeService
{
    public function getAll(): JsonResponse
    {
        $allTaxes = Taxe::all();
        return response()->json($allTaxes);
    }

    public function update($taxeDto, int $taxeId)
    {
        $findTaxe = Taxe::find($taxeId)->update($taxeDto);
        return response()->json($findTaxe);
    }

    public function paymentTaxe(Taxe $taxe, float $value): float
    {
        return (floatval($taxe->percentage) / 100) * $value;
    }

    public function conversionTaxe(float $value): float
    {
        if ($value <= 3000) {
            return (2.0 / 100) * $value;
        }

        return (1.0 / 100) * $value;
    }
}
