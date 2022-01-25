<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Conversao;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $dadosRequest = $request->session()->get('dados');

        $userId = Auth::id();
        $dadosRequest['conversoes'] = Conversao::where('user_id',$userId)->get();

        return view('home', ['dados' => $dadosRequest]);
    }
}
