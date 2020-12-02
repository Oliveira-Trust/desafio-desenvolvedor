<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
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
        $customers = Customer::get();
        $products = Product::get();
        $orders = Order::get();

        $infoCards = [
            [
                'title' => __('Registered customers'),
                'amount' => $customers->count(),
                'text' => __('customers')
            ],
            [
                'title' => __('Registered products'),
                'amount' => $products->count(),
                'text' => __('products')
            ],
            [
                'title' => __('Registered orders'),
                'amount' => $orders->count(),
                'text' => __('orders')
            ]
        ];

        $infoBars = [
            [
                'title' => __('Opened'),
                'percentage' => ($orders->where('status', 'Opened')->count() / $orders->count()) * 100,
                'bg' => 'bg-info'
            ],
            [
                'title' => __('Paid out'),
                'percentage' => ($orders->where('status', 'Paid out')->count() / $orders->count()) * 100,
                'bg' => 'bg-success'
            ],
            [
                'title' => __('Canceled'),
                'percentage' => ($orders->where('status', 'Canceled')->count() / $orders->count()) * 100,
                'bg' => 'bg-danger'
            ]
        ];




        return view('home', compact('infoCards', 'infoBars'));
    }
}
