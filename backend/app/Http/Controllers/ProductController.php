<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductValidation;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductController extends AbstractController
{
    /**
    * Define the Model for abstract Controller
    *
    * @return \Illuminate\Database\Eloquent\Model
    */
    protected function getModel()
    {
        return Product::class;
    }

    /**
    * Display a listing of the resource.
    *
    * @queryParam name string required The name of the product. Example: Pasta de dente
    * @queryParam price int required The price value of the product. Example: 3
    * @queryParam available_quantity int required The Quantity available of products. Example: 50
    * @queryParam tags string required The tag of a product. Example: higiene
    * @queryParam order_by array required array of key value. Key needs to be a attr of Order. Value can be either asc or desc. Example: ?order_by[price]=asc
    * @queryParam limit int required The limit of results. Example: 2
    * @queryParam offset int required The offset to skip number of results. Example: 1
    *
    * @param  Request  $request
    * @param  ProductRepositoryInterface  $productRepository
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request, ProductRepositoryInterface $productRepository)
    {
        $criterias = $request->except('order_by', 'limit', 'offset');
        $products = $productRepository->findBy($criterias, $request->order_by, $request->limit, $request->offset);
        return response()->json(['success' => true, 'data' => $products]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \App\Http\Requests\ProductValidation  $request
    * @return \Illuminate\Http\Response
    */
    public function store(ProductValidation $request)
    {
        $data = $request->all();
        $item = Product::create($data);
        return response()->json(['success' => true, 'data' => $item]);
    }
}
