<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Models\Product;
use App\Models\Category;


class ProductController extends Controller
{
    public function list($order_by='created_at') {
        $direction = 'desc';
        $product = Product::orderBy($order_by, $direction)->paginate(10);
        $lenght = count($product);

        if($lenght == 0) return abort(204);

        return $product;
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return $product;
    }

    public function store(Request $request){
        try {
            $category = Category::findOrFail($request->category_id);

            // Realizar codificação da imagem para base64

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $request->image,
                'category_id' => $request->category_id,
            ]);

            return response()->json(['product' => $product], 201);

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }

    public function update(Request $request, $id){
        try {
            $product = Product::where('id', $id)->update($request->all());

            if($product) return ['product' => $id];

            return abort(404);

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }

    public function sendPhoto(Request $request, $id){
        try {
            $product = Product::findOrFail($id);

            $file = $request->file('file');
            $imageFileType = $file->getClientOriginalExtension();
            $extensions_arr = array("jpg","jpeg","png","gif");

            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
                // Convert to base64
                $image_base64 = base64_encode(file_get_contents($file) );
                $product = Product::where('id', $id)->update(['image' => $image_base64]);
            } else {
                abort(400);
            }

            if($product) return ['product' => $id];

            return abort(404);

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }

    public function delete($id){
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return ['product deleted with success'];

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }
}
