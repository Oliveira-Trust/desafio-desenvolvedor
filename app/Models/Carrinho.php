<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Base;
use Auth;

class Carrinho extends Base
{
    protected $table = "carrinho";

	public function listar ()
    {
		$exibir = self::selectRaw("carrinho.id_produto, produtos.preco, produtos.nome, carrinho.id");
		$exibir->LeftJoin("produtos", "produtos.id", "=", "carrinho.id_produto");
		$exibir->where("id_usuario", Auth::user()->id);
		
		return $exibir->get ();
	}
	
}