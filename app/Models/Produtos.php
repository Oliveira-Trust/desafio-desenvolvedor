<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Base;

class Produtos extends Base
{
    protected $table = "produtos";

	public function exibir ()
    {
		$exibir = self::select();
		
		$exibir->where("ativo", 1);
		
		if(isset($_GET["pesquisar"])){
			
			if($_GET["nome"])
				$exibir->whereRaw("nome like '%".$_GET["nome"]."%'");
			
			if($_GET["minimo"])
				$exibir->whereRaw("preco >= ".$_GET["minimo"]);
			
			if($_GET["maximo"])
				$exibir->whereRaw("preco <= ".$_GET["maximo"]);
			
			
		}
		
		return $exibir->get ();
	}
	
}