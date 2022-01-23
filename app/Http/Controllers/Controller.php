<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function retornarException(\Exception $ex){
        $retornoErro = __("error_message.common_mistake");
        $retornoErro["ex.message"] = str_replace("{change}", $ex->getMessage(), $retornoErro["ex.message"]);
        return response()
                ->json($retornoErro)
                ->setStatusCode($retornoErro["code"]);
    }
}
