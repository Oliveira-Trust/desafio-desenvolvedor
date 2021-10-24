<?php

namespace App\Http\Controllers\Api\v1\Cotacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Cotacao\CotacaoTaxaRangeRequest;
use App\Services\Cotacao\CotacaoTaxaRangeService;

class CotacaoTaxaRangeController extends Controller
{

    public function __construct(
        CotacaoTaxaRangeService $cotacaoTaxaRangeService
    ){
        $this->cotacaoTaxaRangeService = $cotacaoTaxaRangeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return [
            'success' => true,
            'data' => $this->cotacaoTaxaRangeService->get()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CotacaoTaxaRangeRequest $request)
    {
        //
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return [
            'success' => true,
            'data' => $this->cotacaoTaxaRangeService->show($id)
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CotacaoTaxaRangeRequest $request, $id)
    {
        //
        $this->cotacaoTaxaRangeService->storeOrUpdateById($request->validated(), $id);
        
        return [
            'success' => true,
            'message' => 'Atualizado com Sucesso!'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->cotacaoTaxaRangeService->destroyById($id);

        return [
            'success' => true,
            'message' => 'Deletado com Sucesso!'
        ];
    }
}
