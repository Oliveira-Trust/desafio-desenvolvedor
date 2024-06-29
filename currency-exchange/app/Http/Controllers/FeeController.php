<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function get()
    {
        $fee = Fee::all();

        return view('fee/index', ["fee" => $fee]);
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);

        return view('fee/edit', ["fee" => $fee]);
    }

    public function update(UpdateFeeRequest $request)
    {
        $id = $request->input()['id'];

        $fee = Fee::findOrFail($id);
        $fee->update($request->all());

        return redirect()->route('fee')
            ->with('message', 'fee updated successfully');
    }
}
