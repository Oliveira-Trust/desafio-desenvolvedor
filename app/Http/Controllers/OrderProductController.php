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



    public function deleteInMass(Request $request){
        dd($request->all());
        try {
            OrderProduct::whereIn('id', $request->items)->delete();
            return response()->json([ 'status' => true, 'message' => count($request->items) > 1 ? 'Registros deletados com sucesso!' : 'Registro deletado com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'status' => false, 'message' => 'Erro ao deletar os registros.', 'th' =>  $th], 400);
        }
    }
}
