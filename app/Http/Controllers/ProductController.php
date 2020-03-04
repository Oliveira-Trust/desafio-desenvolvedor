<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = str_replace(['.', ','], ['', '.'], $request->price);
        $product->save();
        
        return redirect()->route('products.index');
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
    }

    /**
     * 
     * @param Product $product
     * @return type
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * 
     * @param Request $request
     * @param Product $product
     * @return type
     */
    public function update(Request $request, Product $product)
    {   
        $product->name = $request->name;
        $product->price = str_replace(['.', ','], ['', '.'], $request->price);
        $product->save();
        
        return redirect()->route('products.index');
    }

    /**
     * 
     * @param Product $product
     * @return type
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        
        return redirect()->route('products.index');
    }
    
    public function destroySelected(Request $request)
    {
        Product::destroy($request->ids);
        return;
    }
}
