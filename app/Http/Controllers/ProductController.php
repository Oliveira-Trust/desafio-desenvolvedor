<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductPhoto;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = auth()->user()->products;
        $filtros = [
            'title'         => '',
            'price_initial' => '',
            'price_end'     => '',
            'order'         => ''
        ];

        if($data = $request->all()){

            $products = auth()->user()->products();

            if($data['title']){
                $filtros['title'] = $data['title'];
                $data['title'] = '%' . $data['title'] . '%';
                $products = $products->where('title', 'like', $data['title']);
            }

            if($data['price_initial']){
                $filtros['price_initial'] = $data['price_initial'];
                $products = $products->where('price', '>=', $data['price_initial']);
            }

            if($data['price_end']){
                $filtros['price_end'] = $data['price_end'];
                $products = $products->where('price', '<=', $data['price_end']);
            }


            if($data['order']){
                $filtros['order'] = $data['order'];
                $products = $products->orderBy($data['order'], 'desc')->get();
            }

        }

        return view('product.home', [
            'products'  => $products,
            'filters'   => $filtros
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.add');
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
        $user = auth()->user();

        $data['price'] = str_replace(['.', ','], ['', '.'], $data['price']);

        $product = $user->products()->create($data);

        if($request->hasFile('photos')){
            $photos = $this->imageUpload($request, 'image');
            $product->photos()->createMany($photos);
        }

        return redirect()->route('product.index');
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

        return view('product.product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = auth()->user()->products()->find($id);

        return view('product.edit', compact('product'));
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
        $product = auth()->user()->products()->find($id);

        $data = $request->all();

        $data['price'] = str_replace(['.', ','], ['', '.'], $data['price']);

        $product->update($data);

        if($request->hasFile('photos')){
            $photos = $this->imageUpload($request, 'image');
            $product->photos()->createMany($photos);
        }

        return redirect()->route('product.index')->with('success', 'Produto Alterado com Sucesso!');
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
        return redirect()->route('product.index')->with('success', 'Produto Apagado com Sucesso!');
    }

    public function destroyImage(Request $request, $id)
    {
        $idProduct = $request->only('product');
        $product = auth()->user()->products()->find($idProduct)->first();

        $photo = ProductPhoto::find($id);

        if($photo->product_id !== $product->id){
            return redirect()->route('product.index')->with('danger', 'Você não tem permissao para deletar essa foto!');
        }

        $photo->delete();
        return redirect()->route('product.edit', $idProduct)->with('success', 'Imagem Apagado com sucesso!');
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

        return view('product.products', compact('products'));
    }

}
