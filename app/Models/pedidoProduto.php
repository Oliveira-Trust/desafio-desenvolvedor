<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Base;
use Auth;

class pedidoProduto extends Base
{
    protected $table = "pedido_produto";

	public function listar ()
    {
		$exibir = self::selectRaw("produtos.nome, produtos.preco,produtos.imagem");
		$exibir->LeftJoin("produtos", "produtos.id", "=", "pedido_produto.id_produto");
		$exibir->where("id_pedido", $_GET["p"]);
		
		return $exibir->get ();
    }
}