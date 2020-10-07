<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Models\Category;

class CategoryController extends Controller
{
    public function status() {
        return ['status' => 'conected'];
    }

    public function list($order_by='created_at') {
        $direction = 'desc';
        $category = Category::orderBy($order_by, $direction)->paginate(10);
        $lenght = count($category);

        if($lenght == 0) return abort(204);

        return $category;
    }

    public function show($id) {
        $category = Category::findOrFail($id);
        return $category;
    }

    public function store(Request $request){
        try {

            $category = Category::create([
                'nome' => $request->nome,
            ]);

            return response()->json(['category' => $category], 201);

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }

    public function update(Request $request, $id){
        try {
            $category = Category::where('id', $id)->update($request->all());

            if($category) return ['category' => $id];

            return abort(404);

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }

    public function delete($id){
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return ['category deleted with success'];

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }
}
