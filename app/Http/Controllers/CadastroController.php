<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\ModelCadastro;
use App\User;
use Illuminate\Support\Facades\Event;


class CadastroController extends Controller
{

    public $user;
    public $cadastro;

    public function __construct()
    {
        $this->user = new User();
        $this->cadastro = new ModelCadastro();


    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
           $cadastro = $this->cadastro->all();
           return view('index', compact('cadastro'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=$this->user->all();
        return view('create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Dados do formulario para criação de um novo cliente
        $atualizar=$this->cadastro->create([
            'name'=>$request->name,
            'preço'=>$request->preço,
            'produto'=>$request->produto,
            'id_user'=>$request->id_user

        ]);
        if($atualizar == true){
            return redirect('cadastro');//atualizando a página logo após cadastrar um novo cliente
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cadastro=$this->cadastro->find($id);
        return view('visualizar', compact('cadastro'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cadastro=$this->cadastro->find($id);
        $users=$this->user->all();
        return view('create', compact('cadastro','users'));
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
        //Atualizando os dados após a edição, pegando pelo id
        $this->cadastro->where(['id'=>$id])->update([

            'preço'=>$request->preço,
            'produto'=>$request->produto,
            'id_user'=>$request->id_user
        ]);
        return redirect('cadastro');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=$this->cadastro::findOrFail($id);
        $delete->delete();
        return redirect('cadastro');

    }
}
