<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductPhoto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['show', 'showAll']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = auth('api')->user()->products;

        if($data = $request->all()){

            if($data['title']){
                $data['title'] = '%' . $data['title'] . '%';
                $products = $products->where('title', 'like', $data['title']);
            }

            if($data['price_initial']){
                $products = $products->where('price', '>=', $data['price_initial']);
            }

            if($data['price_end']){
                $products = $products->where('price', '<=', $data['price_end']);
            }


            if($data['order']){
                $filtros['order'] = $data['order'];
                $products = $products->orderBy($data['order'], 'desc')->get();
            }

        }

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth('api')->user();

        $data['price'] = str_replace(['.', ','], ['', '.'], $data['price']);

        $product = $user->products()->create($data);

        if($request->hasFile('photos')){
            $photos = $this->imageUpload($request, 'image');
            $product = $product->photos()->createMany($photos);
        }

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = auth('api')->user()->products()->find($id);

        $data = $request->all();

        $data['price'] = str_replace(['.', ','], ['', '.'], $data['price']);

        $product->update($data);

        if($request->hasFile('photos')){
            $photos = $this->imageUpload($request, 'image');
            $product = $product->photos()->createMany($photos);
        }

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = auth()->user()->products()->find($id);
        $product->delete();
        return response()->json();
    }

    public function destroyImage(Request $request, $id)
    {
        $idProduct = $request->only('product');
        $product = auth('api')->user()->products()->find($idProduct)->first();

        $photo = ProductPhoto::find($id);

        if($photo->product_id !== $product->id){
            return response()->json(['error' => 'Você não tem permissao para deletar essa foto!']);
        }

        $photo->delete();
        return response()->json();
    }

    private function imageUpload(Request $request, $imageColumn)
    {
        $images = $request->file('photos');
        $uploadImages = [];
        foreach ($images as $image){
            list($folder, $file) = explode('/', $image->store('products', 'public'));
            $uploadImages[] = [$imageColumn => $file];
        }

        return $uploadImages;
    }

    public function showAll(Request $request)
    {
        $products = Product::paginate(15);

        return response()->json($products);
    }
}
