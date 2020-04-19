<?php

namespace App\Repositories;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Status;
use App\Models\ItemPedido;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PedidoRepository
{
    private static function insert($pedido) {
      $response = array();
      try {

        $cliente = Cliente::find($pedido["cliente_id"]);
        $status = Status::find($pedido["status_id"]);

        $model = new Pedido;
        $model->cliente()->associate($cliente);
        $model->status()->associate($status);
        $model->total = $pedido['total'];
        $model->save();

        $listaItens = collect();

        foreach($pedido["itens"] as $item) {
          $itemPedido = new ItemPedido;
          $itemPedido->fill($item);
          $listaItens->push($itemPedido);
        }

        if($listaItens->isNotEmpty())
          $model->itens()->saveMany($listaItens);

      } catch (\Exception $e) {
        $response['error'] = "2Houve um erro inesperado!{$e->getMessage()}";
      }

      return $response;
    }

    private static function update($pedido) {
      $response = array();
      try {

        $status = Status::find($pedido["status_id"]);

        $model = Pedido::find($pedido['id']);
        $model->status()->associate($status);
        $model->save();

        $response['data'] = "OK";
      } catch (\Exception $e) {
        $response['error'] = "Houve um problema inesperado!{$e->getMessage()}";
      }
      return $response;
    }

    public static function save($pedido) {
      if(array_key_exists("id", $pedido) && $pedido["id"] != "") {
        return self::update($pedido);
      } else {
        return self::insert($pedido);
      }
    }

    public static function get($id) {
      $response = array();
      try {
        $response["data"] = Pedido::where("id", $id)
            ->with(['cliente','status', 'itens', 'itens','itens.produto'])
            ->first();
      } catch (\Exception $e) {
        $response["error"] = "Houve um erro inesperado!";
      }
      return $response;
    }

    public static function search(Request $request) {
      $response = array();
      try {
        $model = new Pedido;

        if ($request->filled('id')) $model = $model->where('id', $request->id);
        if ($request->filled('cliente'))
            $model = $model->whereHas('cliente', function(Builder $query) use ($request) {
                return $query->where('nome', 'like' , "%{$request->cliente}%");
            });
        if ($request->filled('status_id')) $model = $model->where('status_id', $request->status_id);
        if ($request->filled('total')) $model = $model->where('total', $request->total);

        $response["data"] = $model->with(['cliente','status', 'itens', 'itens','itens.produto'])->get();
      } catch (\Exception $e) {
        $response["error"] = "Houve um erro inesperado!{$e->getMessage()}";
      }
      return $response;
    }

    public static function delete($id) {
      $response = array();
      try {
        $pedido = Pedido::where('id', $id)->with('itens')->first();

        $itensId = collect();

        foreach($pedido->itens as $item) {
          $itensId->push($item->id);
        }

        ItemPedido::destroy($itensId);

        Pedido::destroy($id);

        $response['data'] = "OK";
      } catch (\Exception $e) {
        $response['error'] = "Houve um erro inesperado!";
      }
      return $response;
    }

    public static function deleteAll($ids) {
      $response = array();
      try {
        Pedido::destroy($ids);
        $response['data'] = "OK";
      } catch (\Exception $e) {
        $response['error'] = "Houve um erro inesperado!";
      }
      return $response;
    }
}
