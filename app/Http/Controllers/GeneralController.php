<?php

namespace App\Http\Controllers;

use App\Models\General;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function settings()
    {
        $settings = \DB::table('settions')->get();
        return view('settings',['settings' => $settings]);
    }

    public function settingsStore(Request $request){
        
         \DB::table('settions')
         ->where('id',1)
         ->update([
            'boleto' => $request->input('boleto'), 
            'credito' => $request->input('credito'), 
            'conversaomenor' => $request->input('conversaomenor'), 
            'conversaomaior' => $request->input('conversaomaior')
         ]);

         return redirect()->route('settings');

    }
}
