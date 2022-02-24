<?php

namespace App\Http\Controllers;

use App\Models\Moeda;
use App\Http\Requests\StoreMoedaRequest;
use App\Http\Requests\UpdateMoedaRequest;

class MoedasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moedas = Moeda::paginate(10);

        return view('moedas.index', compact('moedas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('moedas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMoedasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMoedaRequest $request)
    {
        $moeda = new Moeda;
        $moeda->create($request->toArray());

        return redirect()->route('moedas')->with('status', 'Moeda cadastrada com Sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $moeda = Moeda::findOrFail($id);

        return view('moedas.edit', compact('moeda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMoedasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMoedaRequest $request, int $id)
    {
        $moeda = Moeda::findOrFail($id);
        $moeda->nome = $request->nome;
        $moeda->sigla = $request->sigla;
        $moeda->save();

        return redirect()->route('moedas')->with('status', 'Moeda atualizada com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $model = Moeda::findOrFail($id);
        $model->delete();

        return redirect()->route('moedas')->with('status', 'Moeda excluida com Sucesso!');
    }
}
