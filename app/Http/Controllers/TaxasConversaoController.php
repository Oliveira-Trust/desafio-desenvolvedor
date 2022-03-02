<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateConversaoTaxaRequest;
use Illuminate\Http\Request;
use App\Models\TaxasConversao;

class TaxasConversaoController extends Controller
{
    public function index()
    {
        $conversaoTaxas = TaxasConversao::all();

        return view('taxa-conversao.index', compact('conversaoTaxas'));
    }

    public function edit($id)
    {
        return view('taxa-conversao.edit', ['taxa_conversao' => TaxasConversao::find($id)]);
    }

    public function update(UpdateConversaoTaxaRequest $request, $id)
    {
        TaxasConversao::find($id)->update($request->all());

        return redirect()->route('conversao-taxa.index')->with('success', 'Taxa atualizada com sucesso');
    }
}
