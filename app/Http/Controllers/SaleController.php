<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function list($order_by='created_at') {
        $direction = 'desc';
        $sale = Sale::orderBy($order_by, $direction)->paginate(10);
        $lenght = count($sale);

        if($lenght == 0) return abort(204);

        return $sale;
    }

    public function show($id) {
        $sale = Sale::findOrFail($id);
        return $sale;
    }

    public function store(Request $request){
        try {

            $sale = Sale::create([
                'status' => $request->status,
            ]);

            return response()->json(['sale' => $sale], 201);

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }

    public function update(Request $request, $id){
        try {
            $sale = Sale::where('id', $id)->update($request->all());

            if($sale) return ['sale' => $id];

            return abort(404);

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }

    public function delete($id){
        try {
            $sale = Sale::findOrFail($id);
            $sale->delete();

            return ['sale deleted with success'];

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }
}
