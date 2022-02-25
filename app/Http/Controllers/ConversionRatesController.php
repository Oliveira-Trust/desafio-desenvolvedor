<?php

namespace App\Http\Controllers;

use App\Models\ConversionRate;
use App\Http\Requests\UpdateConversionRateRequest;

class ConversionRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $conversion_rates = ConversionRate::all();
        $conditions = [
            'Se o valor for maior que' => ConversionRate::BIGGER_TO,
            'Se o valor for menor que' => ConversionRate::LESS_TO,
        ];

        return view('conversion-rates.index', [
            'conversion_rates' => $conversion_rates,
            'conditions' => $conditions,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  ConversionRate $conversion_rate
     */
    public function show(ConversionRate $conversion_rate)
    {
        return view('conversion-rates.edit', [ 'conversion_rate' => $conversion_rate ]);
    }

    /**
     * Update resources in storage.
     *
     * @param  \Illuminate\Http\UpdateConversionRateRequest  $request
     * @param  ConversionRate $conversion_rate
     */
    public function update(UpdateConversionRateRequest $request, ConversionRate $conversion_rate)
    {
        $conversion_rate->update($request->all());
        alert()->success('Sucesso','Taxa atualizada');

        return redirect()->route('conversion-rates');
    }
}
