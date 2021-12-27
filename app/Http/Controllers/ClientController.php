<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function profile(Request $request){

        $user = Auth::user()->id;
        $dados = Historico::where('user_id','=',Auth::user()->id)->get();
        return view('client.profile',['dados'=>$dados]);

    }
}
