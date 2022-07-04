<?php

namespace App\Http\Controllers;

use App\Facades\Api;


class ApiController extends Controller
{
    /**
     * Método responsável por consultar a cotação geral e atualizada das Moedas
     */
    public function __invoke()
    {
        $cotacao = Api::get('/last/USD-BRL,EUR-BRL,BTC-BRL,CAD-BRL,GBP-BRL,ARS-BRL,AUD-BRL,CHF-BRL,CNY-BRL')->json();
        return view('cotacao')->with('data', $cotacao);
    }

    /**
     * Método responsável por executar a requisição na API.
     * @param string $resource
     * @return array
     * @return \Illuminate\Http\Response
     */
    public function get($resource)
    {
        $endpoint = $this->getEndpoint($resource);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\API  $aPI
     * @return \Illuminate\Http\Response
     */
    public function show(API $aPI)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\API  $aPI
     * @return \Illuminate\Http\Response
     */
    public function edit(API $aPI)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\API  $aPI
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, API $aPI)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\API  $aPI
     * @return \Illuminate\Http\Response
     */
    public function destroy(API $aPI)
    {
        //
    }
}
