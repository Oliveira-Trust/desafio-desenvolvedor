<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {


        if($title = $request->get('search')){

            $products = Product::where('title', 'like', '%'.$title.'%')->paginate(8);

        }else{
            $products = Product::paginate(8);
        }

        return view('home', [
            'products'=> $products,
            'search' => $title
        ]);
    }
}
