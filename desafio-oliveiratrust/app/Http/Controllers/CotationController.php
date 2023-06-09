<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CotationRequest;
use App\Models\Cotation;
use Illuminate\Support\Facades\Redirect;

class CotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }

    public function store(CotationRequest $request)
    {
        // O código de validação anterior pode ser removido do método add

        dd($request);

        $cotation = Cotation::create($request->all());

        return Redirect::route('home')->with('success', 'Cotation added successfully');
    }
}
