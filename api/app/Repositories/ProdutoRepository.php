<?php

namespace App\Repositories;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoRepository
{
    private static function insert($produto) {
      $response = array();
      try {
        $model = new Produto;
        $model->fill($produto);
        $model->save();
        $response['data'] = 'OK';
      } catch (\Exception $e) {
        $response['error'] = "2Houve um erro inesperado!{$e->getMessage()}";
      }
      return $response;
    }

    private static function update($produto) {
      try {
        Produto::where("id", $produto["id"])->update($produto);
        $response['data'] = 'OK';
      } catch (\Exception $e) {
        $response['error'] = "2Houve um erro inesperado!{$e->getMessage()}";
      }
    }

    public static function save($produto) {
      if(array_key_exists("id", $produto) && $produto["id"] != "") {
        return self::update($produto);
      } else {
        return self::insert($produto);
      }
    }

    public static function get($id) {
      $response = array();
      try {
        $response["data"] = Produto::where("id", $id)->first();
      } catch (\Exception $e) {
        $response["error"] = "Houve um erro inesperado!";
      }
      return $response;
    }

    public static function search(Request $request) {
      try {
        $produto = new Produto;

        if ($request->filled('descricao')) $produto = $produto->where('descricao', 'like' , "%{$request->descricao}%");
        if ($request->filled('quantidade')) $produto = $produto->where('quantidade', $request->quantidade);
        if ($request->filled('preco')) $produto = $produto->where('preco', $request->preco);

        $response["data"] = $produto->get(['id', 'descricao', 'preco']);
      } catch (\Exception $e) {
        $response["error"] = "Houve um erro inesperado!{$e->getMessage()}";
      }
      return $response;

    }

    public static function delete($id) {
      $response = array();
      try {
        Produto::destroy($id);
        $response['data'] = "OK";
      } catch (\Exception $e) {
        $response['error'] = "Houve um erro inesperado!";
      }
      return $response;
    }

    public static function deleteAll($ids) {
        $response = array();
        try {
          Produto::destroy($ids);
          $response['data'] = "OK";
        } catch (\Exception $e) {
          $response['error'] = "Houve um erro inesperado!";
        }
        return $response;
      }
}
