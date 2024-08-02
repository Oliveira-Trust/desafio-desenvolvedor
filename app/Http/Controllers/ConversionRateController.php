<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConversionRateFormRequest;
use App\Http\Resources\ConversionRateResource;
use App\Models\ConversionRate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ConversionRateController extends Controller
{

    public function edit(ConversionRate $taxaConversao): Response
    {


        return Inertia::render('ConversionRateEdit', ['conversionRate' => $taxaConversao]);
    }


    public function update(ConversionRateFormRequest $request, ConversionRate $taxaConversao): RedirectResponse
    {
        $taxaConversao->update($request->validated());


        return redirect()->back();
    }

}
