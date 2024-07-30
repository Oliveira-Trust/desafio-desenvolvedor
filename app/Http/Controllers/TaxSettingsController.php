<?php

namespace App\Http\Controllers;

use App\Models\TaxSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxSettingsController extends Controller
{
    public function index()
    {
        $taxSettings = DB::table('tax_settings')->where('user_id', auth()->user()->id)->get();
        return inertia('TaxSettings/Index', [
            'taxSettings' => $taxSettings,
        ]);
    }

    public function edit(int $id)
    {
        return inertia('TaxSettings/Edit', [
            'taxSettings' => TaxSettings::find($id),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $request['boleto_fee'] = sanitizaNumbers($request['boleto_fee']);
        $request['credit_card_fee'] = sanitizaNumbers($request['credit_card_fee']);
        $request['conversion_fee_below_3000'] = sanitizaNumbers($request['conversion_fee_below_3000']);
        $request['conversion_fee_above_3000'] = sanitizaNumbers($request['conversion_fee_above_3000']);

        $request->validate([
            'boleto_fee' => 'required|numeric',
            'credit_card_fee' => 'required|numeric',
            'conversion_fee_below_3000' => 'required|numeric',
            'conversion_fee_above_3000' => 'required|numeric',
        ]);
        $taxSettings = TaxSettings::find($id);
        $taxSettings->update($request->all());
        return redirect()->back()->with('success', 'Taxas Atualizadas com sucesso!');
    }
}
