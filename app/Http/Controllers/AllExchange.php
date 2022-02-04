<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllExchange extends Controller
{
    public function TODO()
    {
        /*
         $data = array(
            'title' => 'My App',
            'Description' => 'This is New Application',
            'author' => 'foo'
         ); 
        */

        $hexchange = DB::select('SELECT * FROM hexchange limit 10');
        return view('list', compact('hexchange'));
    }
}
