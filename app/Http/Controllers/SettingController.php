<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Response;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('setting.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data["user_id"] = \Auth::user()->id;

        //Registra moeda padrão
        $data["code"] = "price";
        $data["key"] = 'currency_from';
        $data["value"] = $request->post("currency_from");
        Setting::updateOrCreate(["user_id" => $data["user_id"], "code" => "price", "key" => "currency_from"], $data);

         //Registra taxa para boleto
         $data["code"] = "price";
         $data["key"] = 'ticket';
         $data["value"] = $request->post("ticket");
         Setting::updateOrCreate(["user_id" => $data["user_id"], "code" => "price", "key" => "ticket"], $data);

        //Registra taxa para cartão
        $data["code"] = "price";
        $data["key"] = "card";
        $data["value"] = $request->post("card");
        Setting::updateOrCreate(["user_id" => $data["user_id"], "code" => "price", "key" => "card"], $data);

        return Response::json(true);

    }

    /**
     * Display the all resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $settings = Setting::where("user_id",1)->where("code", "price")->get();

        return Response::json($settings);
    }

}
