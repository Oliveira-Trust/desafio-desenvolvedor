<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){

        $dados = Config::where('user_id','=',Auth::user()->id)->get();

        return view('admin.dashboard',['dados'=>$dados[0]]);

    }

    public function update(Request $request)
    {

        try{

            if(!$request->all()){
                $e = new \Exception('No data has been sent.');
                throw $e;
            }

            $conf = Config::query()->find($request->id);
            $conf->update($request->all());
        } catch (\Exception $e){
            return response(array('msg'=>$e->getMessage()), 400);
        }


        return redirect()->route('admin.dashboard');
    }

}
