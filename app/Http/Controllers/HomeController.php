<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the welcome.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Remove all Status from storage.
     *
     * @return Response
     */
    public function erase($model)
    {
        $erase = DB::table($model)
            ->update([
                'deleted_at' => Carbon::now()
            ]);
        if ($model == 'purchase_orders') {
            $erase = DB::table('orders_products')
            ->update([
                'deleted_at' => Carbon::now()
            ]);
            $model = 'orders';
        }

        Flash::success('All removed successfully.');

        return redirect(route($model.'.index'));
    }
}
