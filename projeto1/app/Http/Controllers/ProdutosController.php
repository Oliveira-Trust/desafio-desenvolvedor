<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produtos;
use App\Models\Carrinho;
use Session;


class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produtos::SimplePaginate(4);
        return view('produtos.index',array('produtos' => $produtos,'buscar' => null));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            return view('produtos.create');
        }else{
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'sku' => 'required|unique:produtos|min:4',
            'titulo' => 'required|min:3',
            'descricao' => 'required|min:10',
            'preco' => 'required|numeric'
        ]);

        $produto = new Produtos();
        $produto->sku = $request ->input('sku');
        $produto->titulo = $request ->input('titulo');
        $produto->descricao = $request ->input('descricao');
        $produto->preco = $request ->input('preco');

        if($produto->save())
        {
            return redirect('produtos/create')->with('success','Produto Cadastrado com sucesso');
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
        $produto = Produtos::find($id);
        return view('produtos.show',array('produto' => $produto));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check()){
            $produto = Produtos::find($id);
            return view('produtos.edit',compact('produto','id'));
        }else{
            return redirect('login');
        }
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
        $produto = Produtos::find($id);

        $this->validate($request,[
            'sku' => 'required|min:4',
            'titulo' => 'required|min:3',
            'descricao' => 'required|min:10',
            'preco' => 'required|numeric'
        ]);

        if($request->hasfile('imgproduto'))
        {
            $imagem = $request->file('imgproduto');
            $nomearquivo = md5($id).".".$imagem->getClientOriginalExtension();
            $request->file('imgproduto')->move(public_path('./img/produtos/'),$nomearquivo);
        }

        $produto->sku = $request ->get('sku');
        $produto->titulo = $request ->get('titulo');
        $produto->descricao = $request ->get('descricao');
        $produto->preco = $request ->get('preco');

        if($produto->save())
        {
            return redirect('produtos/'.$id.'/edit')->with('success','Produto Atualizado com sucesso');
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
        $produto = Produtos::find($id);
        if(file_exists("./img/produtos/".md5($id).".jpg"))
        {
            unlink("./img/produtos/".md5($id).".jpg");
        }


        $produto->delete();
        return redirect()->back()->with('success','Produto Deletado');
    }

    public function busca(Request $request)
    {
        $buscaInput = $request->input('busca');
        $produto = Produtos::where('titulo','LIKE','%'.$buscaInput.'%')->orwhere('descricao','LIKE','%'.$buscaInput.'%')->
        simplePaginate(4);
        return view('produtos.index',array('produtos' => $produto,'buscar'=>$buscaInput));
    }

    public function addCarinho(Request $request, $id)
    {
        $produto = Produtos::find($id);
        $carrinhoOld = Session::has('carrinho')? Session::get('carrinho'): null;
        $carrinho = new Carrinho($carrinhoOld);
        $carrinho->add($produto,$produto->id);

        $request->session()->put('carrinho',$carrinho);
        //dd($request->session()->get('carrinho'));
        return redirect('produtos');

    }

    public function excluir($id)
    {
        $carrinhoOld = Session::has('carrinho')? Session::get('carrinho'): null;
        $carrinho = new Carrinho($carrinhoOld);
        $carrinho->excluir($id);

        Session::put('carrinho',$carrinho);
        return view('carrinho.shop',array('produtos' => $carrinho->items, 'precototal' => $carrinho-> precoTotal));
    }

    public function carrinho(){
        if(!Session::has('carrinho'))
        {
            return view('carrinho.shop',array('produtos' => null));
        }
        $carrinhoOld = Session::get('carrinho');
        $carrinho = new Carrinho($carrinhoOld);
        return view('carrinho.shop',array('produtos' => $carrinho->items, 'precototal' => $carrinho-> precoTotal));
    }

    public function getCheckout()
    {
        if(!Session::has('carrinho'))
        {
            return view('carrinho.shop',array('produtos' => null));
        }
        $carrinhoOld = Session::get('carrinho');
        $carrinho = new Carrinho($carrinhoOld);
        $total = $carrinho->precoTotal;
        return view('carrinho.checkout',array('total' => $total));

//
    }
}

