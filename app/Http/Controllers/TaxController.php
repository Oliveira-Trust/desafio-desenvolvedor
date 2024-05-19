<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaxRequest;
use App\Models\Tax;
use Inertia\Inertia;

class TaxController extends Controller
{
    public function edit()
    {
        return Inertia::render('Tax/Edit', [
            'taxes' => Tax::enabled()->get()
        ]);
    }

    public function update(UpdateTaxRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['taxes'] as $tax) {
            Tax::find($tax['id'])->update([
                'amount' => $tax['amount'],
                'rate' => $tax['rate'],
                'min_amount_rate' => $tax['min_amount_rate'],
                'max_amount_rate' => $tax['max_amount_rate'],
            ]);
        }

        return redirect()->back()->with('success-message', 'Taxas atualizadas com sucesso!');
    }
}
