<?php

namespace App\Http\Controllers;

use App\Models\Cambio;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\cambio as aviso;
use Illuminate\Support\Facades\Auth;


class CambioController extends Controller
{
    public function cambio(Request $request)
    {
        $cambio = new Cambio();
        $cambio_id = $cambio->Processing($request);

        $user = User::find(Auth::user()->id);
        $user->notify(new aviso());
        return redirect()->route('demostrativo',$cambio_id);
    }

    public function demostrativo($id)
    {
        $opration = \DB::table('conversations')->where('id',$id)->first();
        return view('cambio',['operation' => $opration]);

    }
}
