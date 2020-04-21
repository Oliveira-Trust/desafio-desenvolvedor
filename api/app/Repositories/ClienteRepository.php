<?php

namespace App\Repositories;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteRepository
{
    private static function insert($cliente) {
      $response = array();
      try {
        $model = new Cliente;
        $model->fill($cliente);
        $model->save();
        $response['data'] = 'OK';
      } catch (\Exception $e) {
        $response['error'] = "2Houve um erro inesperado!{$e->getMessage()}";
      }
      return $response;
    }

    private static function update($rqCliente) {
      $response = array();
      try {
        Cliente::where("id", $rqCliente["id"])->update($rqCliente);
        $response['data'] = "OK";
      } catch (\Exception $e) {
        $response['error'] = "3Houve um problema inesperado";
      }
      return $response;
    }

    public static function save($cliente) {
      if(array_key_exists("id", $cliente) && $cliente["id"] != "") {
        return self::update($cliente);
      } else {
        return self::insert($cliente);
      }
    }

    public static function get($id) {
      $response = array();
      try {
        $response["data"] = Cliente::where("id", $id)->first();
      } catch (\Exception $e) {
        $response["error"] = "Houve um erro inesperado!";
      }
      return $response;
    }

    public static function search(Request $request) {
      $response = array();
      try {

        // dd($request);
        $clientes = new Cliente;

        if ($request->filled('id')) $clientes = $clientes->where('id',$request->id);
        if ($request->filled('nome')) $clientes = $clientes->where('nome', 'like' , "%{$request->nome}%");
        if ($request->filled('sobrenome')) $clientes = $clientes->where('sobrenome', 'like' , "%{$request->sobrenome}%");
        if ($request->filled('email')) $clientes = $clientes->where('email', 'like',  "%{$request->email}%");

        $response["data"] = $clientes->select(['id','nome','sobrenome','email'])->get();
      } catch (\Exception $e) {
        $response["error"] = "Houve um erro inesperado!{$e->getMessage()}";
      }
      return $response;
    }

    public static function delete($id) {
      $response = array();
      try {

        $cliente = Cliente::find($id);

        if ($cliente->pedidos->count() > 0) {
          throw new \Exception("Apague os pedidos deste cliente primeiro!");
        }

        Cliente::destroy($id);
        $response['data'] = "OK";
      } catch (\Exception $e) {
        $response['error'] = "Houve um erro inesperado!{$e->getMessage()}";
      }
      return $response;
    }

    public static function deleteAll($ids) {
      $response = array();
      try {
        Cliente::destroy($ids);
        $response['data'] = "OK";
      } catch (\Exception $e) {
        $response['error'] = "Houve um erro inesperado!";
      }
      return $response;
    }
}
