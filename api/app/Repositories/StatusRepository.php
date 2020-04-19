<?php

namespace App\Repositories;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusRepository
{
    private static function insert($status) {
      $response = array();
      try {
        $model = new Status;
        $model->fill($status);
        $model->save();
        $response['data'] = 'OK';
      } catch (\Exception $e) {
        $response['error'] = "2Houve um erro inesperado!{$e->getMessage()}";
      }
      return $response;
    }

    private static function update($status) {
      try {
        Status::where("id", $status["id"])->update($status);
        $response['data'] = 'OK';
      } catch (\Exception $e) {
        $response['error'] = "2Houve um erro inesperado!{$e->getMessage()}";
      }
    }

    public static function save($status) {
      if(array_key_exists("id", $status) && $status["id"] != "") {
        return self::update($status);
      } else {
        return self::insert($status);
      }
    }

    public static function get($id) {
      $response = array();
      try {
        $response["data"] = Status::where("id", $id)->first();
      } catch (\Exception $e) {
        $response["error"] = "Houve um erro inesperado!";
      }
      return $response;
    }

    public static function search(Request $request) {
      try {
        $status = new Status;

        if ($request->filled('descricao')) $status = $status->where('descricao', 'like' , "%{$request->descricao}%");

        $response["data"] = $status->get();
      } catch (\Exception $e) {
        $response["error"] = "Houve um erro inesperado!{$e->getMessage()}";
      }
      return $response;

    }

    public static function delete($id) {
      $response = array();
      try {
        Status::destroy($id);
        $response['data'] = "OK";
      } catch (\Exception $e) {
        $response['error'] = "Houve um erro inesperado!";
      }
      return $response;
    }

    public static function deleteAll($ids) {
        $response = array();
        try {
          Status::destroy($ids);
          $response['data'] = "OK";
        } catch (\Exception $e) {
          $response['error'] = "Houve um erro inesperado!";
        }
        return $response;
      }
}
