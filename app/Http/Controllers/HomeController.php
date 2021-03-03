<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Carrinho;
use App\Models\Pedidos;
use App\Models\Base;
use App\Models\pedidoProduto;
use App\User;

use Illuminate\Support\Facades\URL;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Produtos $produtos, Carrinho $carrinho, Pedidos $pedidos, Base $base, pedidoProduto $pedidoproduto, User $user)
    {
		$this->produtos = $produtos;
		$this->carrinho = $carrinho;
		$this->pedidos = $pedidos;
		$this->base = $base;
		$this->pedidoproduto = $pedidoproduto;
		$this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		if(Auth::check() == true ){
			return $this->home();
		}else{
			return view('auth.login');
		}
    }
	
	public function home()
    {
		$lista_produtos = $this->produtos->exibir();
        return view('home')->with( [ "lista_produtos" => $lista_produtos ] );
    }
	
	public function newproduct()
    {
        return view('produtos.new_product');
    }
	
	public function criarproduto(Request $request)
    {
		$filename = "";
		if($_FILES['file']['tmp_name']){
			$filename = $request->file('file')->store('img/produtos');
			move_uploaded_file($_FILES['file']['tmp_name'],$filename);		
		}
			
		$this->produtos->insert([ "nome" => $request->nome, "preco" => $request->preco, "imagem" => $filename, "descricao" => $request->descricao, "ativo" => 1 ]);
		
		echo "<script>alert('Produto cadastrado!');</script>";
        return $this->editarproduto();
    }
	
	public function editarproduto()
    {
		$lista_produtos = $this->produtos->select()->get();
        return view('produtos.edit_product')->with( [ "lista_produtos" => $lista_produtos ] );
    }
	
	public function addCarrinho()
    {
		$this->carrinho->insert([ "id_produto" => $_GET["p"], "id_usuario" => Auth::user()->id ]);
		$lista_produtos = $this->carrinho->listar();
        return view('produtos.car')->with( [ "lista_produtos" => $lista_produtos ] );
    }
	
	public function carrinho()
    {
		$lista_produtos = $this->carrinho->listar();
        return view('produtos.car')->with( [ "lista_produtos" => $lista_produtos ] );
    }
	
	public function remover()
    {
		$this->carrinho->where( ["id" => $_GET["id"] ] )->delete();
        $lista_produtos = $this->carrinho->listar();
        return view('produtos.car')->with( [ "lista_produtos" => $lista_produtos ] );
    }
	
	public function finalizar()
    {
		$this->pedidos->insert([ "data" => date("Y-m-d H:i:s"), "id_cliente" => Auth::user()->id, "id_status" => 1 ]);
		$id = Pedidos::latest('id')->first()->id;
		$lista_carrinho = $this->carrinho->selectRaw("count(*) as quantidade, id_produto, id_usuario")->where("id_usuario", Auth::user()->id)->groupBy("id_usuario","id_produto")->get();
		
		foreach($lista_carrinho as $itens){
			$this->pedidoproduto->insert([ "id_pedido" => $id, "id_produto" => $itens->id_produto, "quantidade" => $itens->quantidade ]);
		}
		$this->carrinho->where( ["id_usuario" => Auth::user()->id ] )->delete();
		
		$lista_pedidos = $this->pedidos->select()->where("id_cliente", Auth::user()->id)->get();
		
        return view('pedidos.list')->with( [ "lista_produtos" => $lista_pedidos ] );
    }
	
	public function pedidos()
    {

		$lista_pedidos = $this->pedidos->listar();
		
        return view('pedidos.list')->with( [ "lista_pedidos" => $lista_pedidos ] );
    }
	
	public function tratar()
    {

		$this->pedidos->where("id", $_GET["p"])->update([ "id_status" => $_GET["s"] ]);
		
        return $this->pedidos();
    }
	
	public function detalhes()
    {

		$detalhes = $this->pedidoproduto->listar();
		
        return view('pedidos.details')->with( [ "detalhes" => $detalhes ] );
    }
	
	public function ativar()
    {		
		$this->produtos->where("id", $_GET["p"])->update([ "ativo" => 1 ]);
        return back ();
    }
	
	public function desativar()
    {		
		$this->produtos->where("id", $_GET["p"])->update([ "ativo" => 0 ]);
        return back ();
    }
	
	public function atualizar(Request $request)
    {		
		if($_FILES['file']['tmp_name']){
			$filename = $request->file('file')->store('img/produtos');
			move_uploaded_file($_FILES['file']['tmp_name'],$filename);
			$this->produtos->where("id", $request->id)->update([ "imagem" => $filename ]);
		}
		
		$this->produtos->where("id", $request->id)->update([ "nome" => $request->nome, "preco" => $request->preco, "descricao" => $request->descricao ]);
        return back ();
    }
	
	public function tratapedido()
    {		
		$lista_pedidos = $this->pedidos->listar();
		
        return view('pedidos.admin')->with( [ "lista_pedidos" => $lista_pedidos ] );
    }
	
	public function usuarios()
    {		
		$lista_usuarios = $this->user->exibir();
		
        return view('users')->with( [ "lista_usuarios" => $lista_usuarios ] );
    }
	
	public function edituser()
    {		
		$this->user->where("id", $_GET["p"])->update([ "active" => $_GET["a"] ]);
		
        return back ();
    }
	
	public function massivo(Request $request)
    {	
		if($request->itens){
			foreach($request->itens as $itens){
				$this->produtos->where("id", $itens)->update([ "ativo" => 0 ]);
			}
		}
		 return back ();
    }
}
