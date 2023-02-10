<?php

namespace App\Http\Controllers;

use App\Models\Taxa;
use Illuminate\Http\Request;
use DB;
use stdClass;

class TaxaController extends Controller
{
    public function index()
    {
        return view('taxas');
    } 

    public function getAll()
    {
        $result = Taxa::all();
        return $result;

    }
    
    public function store(Request $request)
    {  
       
        $this->validate($request,[
            'valor_max' => ['required'],
            'valor_min' => ['required'],
            'por_cento' => ['required']            
        ],[
            'valor_max.required' => 'O campo valor máximo não pode ser vazio',
            'valor_min.required' => 'O campo valor mínimo não pode ser vazio',
            'por_cento.required' => 'O campo por cento não pode ser vazio'
        ]);
        
        Taxa::create($request->all());       
        return "success";        

    }

    public function show(Taxa $taxa)
    {       
       return $taxa;
    } 

    public function update(Request $request)
    {
                
        $student = Taxa::find($request->id)->update($request->all());
        return "success";

    }

    public function destroy($id)
    {
        $student = Taxa::find($id)->delete();
        return "success";
    }

    public function TaxaConversao(Request $request)
    {
        $conversao = DB::table('taxas')->where('valor_max', '>=', $request->valor)->where('valor_min', '<=', $request->valor)->get();
        return  response()->json(["mensaje"=>"Success", "data"=> $conversao], 200) ;
    }

    public function CalculoConversao(Request $request)
    {
        $conversao = DB::table('taxas')->where('valor_max', '>=', $request->valor_conversao)->where('valor_min', '<=', $request->valor_conversao)->get();
        $taxa_conversao = $conversao[0]->por_cento;

        $taxa_pag = 0;
        $taxa_conv= 0;

        $dados = new stdClass();
      
      
        $taxa_conv =  round( ($request->valor_conversao * $taxa_conversao) / 100  ,2) ;
         

        if ($request->forma_pagamento == 1) {

            $taxa_pag = round( ($request->valor_conversao * 1.45) / 100,2) ;

        } else {

            $taxa_pag = round( ($request->valor_conversao * 7.63) / 100 ,2) ;
        }

        $valor_usado_para_conversao = $request->valor_conversao - ($taxa_conv + $taxa_pag);

        $valor_comprado_final = round(($valor_usado_para_conversao / $request->valor_usado_conversao),2);

        $dados->taxa_conv = $taxa_conv;
        $dados->taxa_pag  = $taxa_pag;
        $dados->valor_usado_para_conversao = $valor_usado_para_conversao;
        $dados->valor_comprado_final = $valor_comprado_final;
        
        return response()->json(["mensaje"=>"Success", "data"=> $dados], 200);
      
    }
}
