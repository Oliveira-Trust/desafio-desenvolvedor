<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyTaxRequest;
use App\Models\CurrencyTax;

class CurrencyTaxController extends Controller
{

    function __construct()
    {
        $this->middleware('role:Currency Conversion Edit Tax', ['only' => ['index', 'edit', 'update']]);
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Dados = CurrencyTax::findOrFail(1);
        return view('CurrencyTax/View', compact(['Dados']));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CurrencyTax  $currencyTax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $Dados = CurrencyTax::findOrFail(1);
        return view('CurrencyTax/Edit', compact(['Dados']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCurrencyTaxRequest  $request
     * @param  \App\Models\CurrencyTax  $currencyTax
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyTaxRequest $request, $id)
    {
        $Dados = CurrencyTax::find(1);
        $Valores=  $request->all();
        $Valores['less_value']  = str_replace(',', '.', str_replace('.', '', $Valores['less_value']));
        $Valores['bigger_value']  = str_replace(',', '.', str_replace('.', '', $Valores['bigger_value']));

        $Dados->update($Valores);

        return view('CurrencyTax/View', compact(['Dados']));
    }


}
