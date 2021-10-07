<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historico;
use Carbon\Carbon;

class HistoricoController extends Controller
{
    //Listar historicos de cotação
    public function show($id = null, Request $request){
        $admin = $request->admin;
        $usuario = $request->usuario_id;

        if($id==null){
            $historicos = Historico::with('usuario');
            if($admin==0){
                $historicos->where('usuario_id',$usuario);
            }
            return response([
                'historicos' => $historicos->get(),
                'rows'=>$historicos->count(),
                'message' => 'Históricos encontrados com Sucesso!',
                'status' => true
            ]);
        }else{
            $historicos = Historico::with('usuario')->find($id);
            return response([
                'historicos' => $historicos,
                'message' => 'Históricos encontrados com Sucesso!',
                'status' => true
            ]);
        }

    }
    //TODO: Função para criação de historico caso seja necessario
    public function create(Request $request){

    }

    //Editar Historico de cotação
    public function update($id, Request $request){
        $update = $request->all();
        $historico = Historico::where('id', $id)->update($update);
        return response([
            'historico'=>$historico,
            'message' => 'Históricos Atualizado com Sucesso!',
            'status' => true
        ]);
    }

    //Remover Historico de cotação
    public function delete($id){

        $historico = Historico::find($id);
        $historico->delete();

        return response([
            'message' => 'Históricos removido com Sucesso!',
            'status' => true
        ]);
    }
}
