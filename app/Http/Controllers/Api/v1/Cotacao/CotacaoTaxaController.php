<?php

namespace App\Http\Controllers\Api\v1\Cotacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Cotacao\CotacaoTaxaRequest;

use App\Services\Cotacao\CotacaoTaxaService;

class CotacaoTaxaController extends Controller
{

    protected CotacaoTaxaService $cotacaoTaxaService;

    public function __construct(
        CotacaoTaxaService $cotacaoTaxaService
    ){
        $this->cotacaoTaxaService = $cotacaoTaxaService;
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
            'data' => $this->cotacaoTaxaService->get()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CotacaoTaxaRequest $request)
    {
        //
        $this->cotacaoTaxaService->store($request->validated());
        return [
            'success' => true,
            'message' => 'Criado com Sucesso!'
        ];
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
            'data' => $this->cotacaoTaxaService->show($id)
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CotacaoTaxaRequest $request, $id)
    {
        //
        $this->cotacaoTaxaService->updateById($request->validated(), $id);
        
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
        $this->cotacaoTaxaService->destroyById($id);

        return [
            'success' => true,
            'message' => 'Deletado com Sucesso!'
        ];         
    }
}
