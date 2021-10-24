<?php

namespace App\Http\Controllers\Api\v1\Tipo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Tipo\TipoCobrancaRequest;
use App\Services\Tipo\TipoCobrancaService;

class TipoCobrancaController extends Controller
{

    protected TipoCobrancaService $tipoCobrancaService;

    public function __construct(
        TipoCobrancaService $tipoCobrancaService
    ){
        $this->tipoCobrancaService = $tipoCobrancaService;
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
            'data' => $this->tipoCobrancaService->get()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoCobrancaRequest $request)
    {
        //
        try {
            $this->tipoCobrancaService->store($request->validated());
            return [
                'success' => true,
                'message' => 'Criado com Sucesso!'
            ];
        } catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
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
            'data' => $this->tipoCobrancaService->show($id)
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoCobrancaRequest $request, $id)
    {
        //
        $this->tipoCobrancaService->updateById($request->validated(), $id);

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
        $this->tipoCobrancaService->destroyById($id);

        return [
            'success' => true,
            'message' => 'Deletado com Sucesso!'
        ];
        
    }
}