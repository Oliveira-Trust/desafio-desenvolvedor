<?php

namespace App\Http\Controllers;

use App\Order;
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
        return view('home')
            ->with('typing',count(Order::query()->byAuthorizedUser()->where('status',Order::TYPING_ORDER)->get()))
            ->with('awaitingPayment',count(Order::query()->byAuthorizedUser()->where('status',Order::AWAITING_PAYMENT)->get()))
            ->with('paymentConfirmed',count(Order::query()->byAuthorizedUser()->where('status',Order::CONFIRMED_PAYMENT)->get()))
            ->with('cancelled',count(Order::query()->byAuthorizedUser()->where('status',Order::CANCELLED)->get()));
    }
}
