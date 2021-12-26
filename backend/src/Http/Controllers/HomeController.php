<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

final class HomeController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $res = $this->http->search();
        $dataBind = [];
        foreach($res as $item){
            $dataBind[] = [
                "id" => "",
                "code" => $item->codein . "-" . $item->code,
                "name" => $item->name,
                "sale_price" => $item->bid,
                "buy_price" => $item->ask,
            ];
        }
        return $response->withJson(["status"=>"sucesso", "data" => $dataBind], 200);
    }
    public function getCurrency(Request $request, Response $response, $param)
    {
        $code = $param['code'];
        $res = $this->http->search($code);
        $coin = $res[0];
        $data = [
            "id" => "",
            "code" => $coin->codein . "-" . $coin->code,
            "name" => $coin->name,
            "sale_price" => $coin->bid,
            "buy_price" => $coin->ask,
        ];
        return $response->withJson(["status"=>"sucesso", "data" => $data], 200);
    }
    public function exchenge(Request $request, Response $response, $param)
    {
        $userId = (int) $param['userid'];
        $data = $request->getParams();

        if ($userId){
            $userRepository = $this->container->get('UserRepository');
            $user = $userRepository->getById($userId);
        }
        return $response->withJson(["status"=>"sucesso", "data" => $data], 200);
    }
}