<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    public function history()
    {
        $history = \DB::table('conversations')->where('user_id',Auth::user()->id)->get();
        return view('history',['cambios' => $history]);
    }
}
