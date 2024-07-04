<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeController extends Controller
{
    public function get()
    {
        $fees = Fee::all(); // Using the Fee model to get all fees
        return view('fees.index', ['fees' => $fees]);
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id); // Find the fee or throw a 404 error
        return view('fees.edit', ['fee' => $fee]);
    }

    public function update(Request $request, $id)
    {
        $fee = Fee::findOrFail($id);
        $fee->update([
            'name' => $request->name,
            'rate' => $request->rate,
            'threshold' => $request->threshold,
        ]);

        return redirect()->route('fees')->with('success', 'Fee updated successfully.');
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();
        return redirect()->route('fees')->with('success', 'Fee deleted successfully.');
    }

}
