<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = \App\Client::count();
        $products = \App\Product::count();
        $purchaseRequests = \App\PurchaseRequest::count();
        
        return view('home', [
            'clients' => $clients,
            'products' => $products,
            'purchaseRequests' => $purchaseRequests
        ]);
    }
}
