<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Base;
use Auth;

class Pedidos extends Base
{
    protected $table = "pedidos";

	public function listar ($perfil = null)
    {
		$exibir = self::selectRaw("pedidos.id, pedidos.data, status.status");
		$exibir->LeftJoin("status", "status.id", "=", "pedidos.id_status");
		if(!$perfil)
		$exibir->where("id_cliente", Auth::user()->id);
		
		return $exibir->orderBy("data", "desc")->get ();
	}
}