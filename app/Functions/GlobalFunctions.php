
<?php
use Illuminate\Support\Facades\DB;

    function Get_info_item_pedido($id_pedido,$id_item,$type)
    {
        $pedido = \App\Models\Pedidos::findOrFail($id_pedido);
        $pedidos_info = DB::table('pedido_items')
        ->select('quantidade', 'valor_item', 'desconto')
        ->where([
            ['id_pedido', '=', $id_pedido],
            ['id_item', '=', $id_item],
        ])
        ->get();
        $return = "";
        if(count($pedidos_info) >0)
        {
            switch ($type)
            {
                case "D" : $return = $pedidos_info[0]->desconto; break;
                case "V" : $return =  $pedidos_info[0]->valor_item;break;
                case "Q" : $return =  $pedidos_info[0]->quantidade;break;
                case "L" : $return =   ($pedidos_info[0]->quantidade*$pedidos_info[0]->valor_item)-(($pedidos_info[0]->quantidade*$pedidos_info[0]->valor_item)*($pedidos_info[0]->desconto/100));  break;
            } 
        }else return 0;
        return $return;
    }

?>