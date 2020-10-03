<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Yajra\DataTables\DataTables;

class ClientesController extends Controller
{
    /**
     * Exibe a lista de clientes cadastrados
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        if($request->ajax()) {
            return datatables()->of(Cliente::select('*'))
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="editCliente btn btn-primary btn-sm">Editar</button>';
                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Excluir</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    
      
        return view('clientes.listar');
    }

    /**
     * Exibe o formulário de cadastro de um produto
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        //return view ('clientes.create');
    }


    /**
     * Armazena o cadastro de um novo cliente
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        Cliente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'dt_nascimento' => $request->dt_nascimento,
            'telefone' => $request->telefone,
            'email' => $request->email
        ]);

        return response()->json(['success' => 'Registro criado com sucesso.']);
    }


    /**
     * Exibe o formulário de ediçao de um cliente
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        if(request()->ajax())
        {
            $data = Cliente::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Atualiza um determinado cliente
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente){

        $form_data = array(
            'nome'              =>  $request->nome,
            'cpf'               =>  $request->cpf,
            'dt_nascimento'     =>  $request->dt_nascimento,
            'telefone'          =>  $request->telefone,
            'email'             =>  $request->email
        );

        Cliente::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Registro atualizado com sucesso.']);

    }


    /**
     * Exclui um cliente da base de dados
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $data = Cliente::findOrFail($id);
        $data->delete();
    }
}
