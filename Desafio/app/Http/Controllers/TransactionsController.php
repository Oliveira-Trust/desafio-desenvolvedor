<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::all();
        $transactions =  $transaction->load('clientes');
        return response()->Json([
            'trasancitons'=> $transaction,
            'res'=>'O recurso solicitado foi processado e retornado com sucesso.'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = [              
            'status' => $request->cost,
        ];           
        $transaction = Transaction::create($dados);                          
            if ($transaction) {
                return response()->Json([
                    'trasancitons'=> $transaction,
                    'res'=>'O recurso informado foi criado com sucesso.'
                ], 201);
            }
        return response()->Json([
            'res'=>'A requisição foi recebida com sucesso, porém contém parâmetros inválidos.'
        ], 422); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaction::findOrFail($id);     
        return response()->Json([
            'trasancitons'=> $transaction,
            'res'=>'O recurso solicitado foi processado e retornado com sucesso.'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {           
            $transaction = Transaction::findOrFail($id);

            if($transaction){
                 
                $data = $request->all();           
                $transaction->update($data);
                return response()->Json([
                    'trasancitons'=> $transaction,
                    'res'=>'O recurso informado foi alterado com sucesso.'
                ], 201);   
            } 
            return response()->Json([
                'res'=>'A requisição foi recebida com sucesso, porém contém parâmetros inválidos.'
            ], 422); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);        
        if($transaction->delete()){
            return response()->Json([
                'trasancitons'=> $transaction,
                'res'=>'O recurso informado foi deletado com sucesso.'
            ], 201);;  
        }
        return response()->Json([
            'res'=>'A requisição foi recebida com sucesso, porém contém parâmetros inválidos.'
        ], 422);
    }
}