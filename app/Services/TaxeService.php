<?php

namespace App\Services;

use App\Models\Taxe;

class TaxeService
{
    public function getTaxes()
    {
        $taxes = Taxe::all();

        return $taxes;
    }

    public function updateTaxes($taxes)
    {
        foreach($taxes as $key => $value) {
            Taxe::where('name', $key)->update(['percentage' => $value]);
        }

        return redirect()->back();
    }
}
