<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

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
        $productsList = Product::paginate(5);

        $viewData = [
            'productList' => $productsList,
        ];

        return view('dashboard.products.list', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'unique:products,name'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'image' => ['image', 'mimes:png,jpg'],
        ]);

        $name = $request->input('name');
        $price = $request->input('price');
        $description = $request->input('description');

        if ($request->hasFile('image')) {

            $image = $request->file('image')->store('products');
        } else {
            $image = 'https://via.placeholder.com/100';
        }

        $newProduct = new Product;

        $newProduct->name = $name;
        $newProduct->price = $price;
        $newProduct->description = $description;
        $newProduct->image = $image;

        $newProduct->save();

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
        $product = Product::find($id);

        $viewData = ['product' => $product];

        if ($product) {
            return view('dashboard.products.show', $viewData);
        } else {
            return redirect()->route('products.index')->with('error', 'Usuário não encontrado !');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        $viewData = ['product' => $product];

        if ($product) {
            return view('dashboard.products.edit', $viewData);
        } else {
            return redirect()->route('products.index')->with('error', 'Produto não encontrado !');
        }
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
        $request->validate([
            'name' => ['required', 'string', 'unique:products,name'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'image' => ['image', 'mimes:png,jpg'],
        ]);

        $editedProduct = Product::find($id);

        $name = $request->input('name');
        $price = $request->input('price');
        $description = $request->input('description');
        $image = $editedProduct->image;

        if ($request->hasFile('image')) {
            $imageExists = Storage::disk('public')->exists($editedProduct->image);

            if ($imageExists) {
                Storage::disk('public')->delete($product->image);
            }
            $image = $request->file('image')->store('products');
        }

        $editedProduct->name = $name;
        $editedProduct->price = $price;
        $editedProduct->description = $description;
        $editedProduct->image = $image;

        $editedProduct->save();

        return redirect()->route('products.index')->with('success', 'Produto editado com sucesso !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findedProduct = Product::find($id);

        if ($findedProduct) {
            $imageExists = Storage::disk('public')->exists($findedProduct->image);
            if ($imageExists) {
                Storage::disk('public')->delete($findedProduct->image);
            }
            $findedProduct->delete();
            return redirect()->route('products.index')->with('success', 'Produto removido com sucesso !');
        } else {
            return redirect()->route('products.index')->with('error', 'Não foi possível remover o produto!');
        }
    }

    public function search(Request $request)
    {
        $queryString = $request->input(['search']);

        $request->validate([
            'search' => ['required', 'string'],
        ]);

        // $listProducts = Product::where('name', 'like', '%' . $queryString . '%')
        //     ->where('price', 'like', '%' . $queryString . '%')
        //     ->where('description', 'like', '%' . $queryString . '%')
        //     ->simplePaginate(5);

        $listProducts = DB::table('products')->where('name', 'like', '%' . $queryString . '%')
            ->orWhere('price', 'like', '%' . $queryString . '%')
            ->orWhere('description', 'like', '%' . $queryString . '%')
            ->get();

        $viewData = ['productList' => $listProducts];
        return view('dashboard.products.list', $viewData);
    }

}
