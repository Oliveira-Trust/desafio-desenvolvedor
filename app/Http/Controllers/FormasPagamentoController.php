<?php

namespace App\Http\Controllers;

use App\Models\FormasPagamento;
use App\Http\Requests\StoreFormasPagamentoRequest;
use App\Http\Requests\UpdateFormasPagamentoRequest;

class FormasPagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formas = FormasPagamento::paginate(10);

        return view('formas-pagamentos.index', compact('formas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formas-pagamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFormasPagamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormasPagamentoRequest $request)
    {
        $moeda = new FormasPagamento;
        $moeda->create($request->toArray());

        return redirect()->route('formas.pags')->with('status', 'Forma de Pagamento cadastrada com Sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $forma = FormasPagamento::findOrFail($id);

        return view('formas-pagamentos.edit', compact('forma'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFormasPagamentoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormasPagamentoRequest $request, int $id)
    {
        $forma = FormasPagamento::findOrFail($id);
        $forma->nome = $request->nome;
        $forma->taxa = $request->taxa;
        $forma->save();

        return redirect()->route('formas.pags')->with('status', 'Forma de Pagamento atualizada com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $model = FormasPagamento::findOrFail($id);
        $model->delete();

        return redirect()->route('formas.pags')->with('status', 'Forma de Pagamento excluida com Sucesso!');
    }
}
