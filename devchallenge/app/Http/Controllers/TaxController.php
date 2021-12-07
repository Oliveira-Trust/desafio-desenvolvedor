<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tax;
use App\Http\Requests\UpdateTaxRequest;
use Illuminate\Support\Facades\Validator;

class TaxController extends Controller
{
    /**
     * Display the currency conversion screen.
     *
     * @return \Illuminate\View\View
    */
    public function get()
    {
        $tax = Tax::all();

        return view('tax/index', ["tax" => $tax]);
    }

    public function edit($id)
    {
        $tax = Tax::findOrFail($id);

        return view('tax/edit', ["tax" => $tax]);
    }

    public function update(UpdateTaxRequest $request)
    {
        $id = $request->input()['id'];
        
        $tax = Tax::findOrFail($id);
        $tax->update($request->all());

        return redirect()->route('tax')
            ->with('message', 'Tax updated successfully');
    }
}
