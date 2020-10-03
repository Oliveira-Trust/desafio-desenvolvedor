<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Yajra\DataTables\DataTables;

class ProdutosController extends Controller
{
    /**
     * Exibe a lista de produtos cadastrados
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        if($request->ajax()) {
            return datatables()->of(Produto::select('*'))
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Editar</button>';
                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Excluir</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    
      
        return view('produtos.listar');
    }


    /**
     * Exibe o formulário de cadastro de um produto
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view ('produtos.create');
    }


    /**
     * Armazena o cadastro de um novo produto
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        Produto::create([
            'nome' => $request->nome,
            'quantidade' => $request->quantidade,
            'valor' => $request->valor
        ]);

        return response()->json(['success' => 'Registro criado com sucesso.']);
    }


    /**
     * Exibe o formulário de ediçao de um produto
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        if(request()->ajax())
        {
            $data = Produto::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Atualiza um determinado produto
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto){

        $form_data = array(
            'nome'      =>  $request->nome,
            'valor'     =>  $request->valor,
            'quantidade'     =>  $request->quantidade,
        );

        Produto::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Registro atualizado com sucesso.']);

    }


    /**
     * Exclui um produto da base de dados
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $data = Produto::findOrFail($id);
        $data->delete();
    }
}
