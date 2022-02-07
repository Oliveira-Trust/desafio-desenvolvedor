<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Taxa;
use Illuminate\Support\Facades\Auth;

class TaxaController extends Controller
{

    public function getTaxas()
    {
        return Taxa::all();
    }

    public function salvarTaxas()
    {
        if (request()->isMethod('POST')) {

            $taxa = Taxa::create(request()->all());
            return response()->json(['taxa' => $taxa]);
        }
    }
}
