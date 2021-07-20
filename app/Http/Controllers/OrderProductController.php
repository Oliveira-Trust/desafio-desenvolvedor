<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Repositories\OrderProductRepository;

class OrderProductController extends Controller
{
    
    /**
     * Pesquisa e pagina os registros de pedidos.
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request, OrderProductRepository $model){
        return $model->search($request->all());
    }



    public function deleteInMass(Request $request, OrderProductRepository $model){
        //dd($request->all(), $request->fullUrl());
        $model->deleteInMass($request->all(), $request->fullUrl());
        return response()->json([ 'status' => true, 'message' => count($request->items) > 1 ? 'Registros deletados com sucesso!' : 'Registro deletado com sucesso!'], 200);
    }
}
