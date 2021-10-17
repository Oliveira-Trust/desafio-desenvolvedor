<?php

namespace App\Http\Controllers\Awesome;

use App\Http\Controllers\Controller;
use App\Services\TaxeService;
use Illuminate\Http\Request;

class TaxeController extends Controller
{
    private $taxesService;

    public function __construct()
    {
        $this->taxesService = new TaxeService();
    }

    public function index()
    {
        $taxes = $this->taxesService->getTaxes();
        return view('taxes', compact('taxes'));
    }


    public function update(Request $request)
    {
       return $this->taxesService->updateTaxes($request->except('_token'));
    }


}
