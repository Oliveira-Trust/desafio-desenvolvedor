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
        $ordersTotal = $orders->count();

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
                'amount' => $ordersTotal,
                'text' => __('orders')
            ]
        ];

        $infoBars = array();

        if (!empty($ordersTotal)) {
            $infoBars = [
                [
                    'title' => __('Opened'),
                    'percentage' => ($orders->where('status', 'Opened')->count() / $ordersTotal) * 100,
                    'bg' => 'bg-info',
                    'status_total' => $orders->where('status', 'Opened')->count(),
                ],
                [
                    'title' => __('Paid out'),
                    'percentage' => ($orders->where('status', 'Paid out')->count() / $ordersTotal) * 100,
                    'bg' => 'bg-success',
                    'status_total' => $orders->where('status', 'Paid out')->count(),
                ],
                [
                    'title' => __('Canceled'),
                    'percentage' => ($orders->where('status', 'Canceled')->count() / $ordersTotal) * 100,
                    'bg' => 'bg-danger',
                    'status_total' => $orders->where('status', 'Canceled')->count(),
                ]
            ];
        }

        return view('home', compact('infoCards', 'infoBars', 'ordersTotal'));
    }
}
