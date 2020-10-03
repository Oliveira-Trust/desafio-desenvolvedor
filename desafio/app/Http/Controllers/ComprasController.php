<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprasController extends Controller
{
    /**
     * Exibe a lista de clientes cadastrados
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $produtos = DB::table('produtos')->get();
        $clientes = DB::table('clientes')->get();

        if($request->ajax()) {
            return datatables()->of(
                        DB::table('compras')
                        ->select('compras.id','produtos.nome as produto_nome','clientes.nome as cliente_nome','compras.quantidade','compras.dt_compra','compras.status')
                        ->join('produtos','produtos.id','=','compras.produto_id')
                        ->join('clientes','clientes.id','=','compras.cliente_id')
                    )
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="editCompra btn btn-primary btn-sm">Editar</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Excluir</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
      
        return view('compras.listar', compact('produtos','clientes'));
    }

    /**
     * Exibe o formulário de cadastro de um produto
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        //return view ('compras.create');
    }


    /**
     * Armazena o cadastro de uma nova compra
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        Compra::create([
            'dt_compra' => $request->dt_compra,
            'produto_id' => $request->produto_id,
            'cliente_id' => $request->cliente_id,
            'quantidade' => $request->quantidade,
            'status' => $request->status
        ]);

        return response()->json(['success' => 'Registro criado com sucesso.']);
    }


    /**
     * Exibe o formulário de ediçao de uma compra
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        if(request()->ajax())
        {
            $data = Compra::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Atualiza um determinada compra
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra){

        $form_data = array(
            'dt_compra'     =>  $request->dt_compra,
            'produto_id'    =>  $request->produto_id,
            'cliente_id'    =>  $request->cliente_id,
            'quantidade'    =>  $request->quantidade,
            'status'        =>  $request->status
        );

        Compra::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Registro atualizado com sucesso.']);

    }


    /**
     * Exclui uma compra da base de dados
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $data = Compra::findOrFail($id);
        $data->delete();
    }
}
