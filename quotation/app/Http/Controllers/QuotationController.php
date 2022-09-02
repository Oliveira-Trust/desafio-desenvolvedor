<?php

namespace App\Http\Controllers;

use App\Services\Quotation;

class QuotationController extends Controller
{
    public function types()
    {
        $quotation = new Quotation();
        return response()->json($quotation->getTypes());
    }

    public function bid(string $source, string $target)
    {
        $quotation = new Quotation($source, $target);
        return response()->json([$quotation->getBid()]);
    }
}
