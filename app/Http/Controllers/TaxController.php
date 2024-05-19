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

    public function update(UpdateTaxRequest $request, string $id)
    {
        //
    }
}
