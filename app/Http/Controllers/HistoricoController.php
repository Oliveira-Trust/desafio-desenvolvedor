<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HistoricoController extends Controller
{

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            if(!$request->all()){
                $e = new \Exception('No data has been sent.');
                throw $e;
            }

            $historico = Historico::create($request->all());

            Session::flash('message', 'Processado com sucesso!');

        } catch(\Exception $e){
            Session::flash('message', 'Processado com sucesso!');
            return response(array('msg'=>$e->getMessage()), 400);
        }

        return response($historico, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historico  $historico
     * @return \Illuminate\Http\Response
     */
    public function show(Historico $historico)
    {
        //
    }


}
