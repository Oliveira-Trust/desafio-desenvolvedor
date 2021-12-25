<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

final class HomeController extends Controller
{    
    public function index(Request $request, Response $response )
    {
        return $response->withJson(["sucesso"=> true], 200);
    }
    public function destroy(Request $request, Response $response)
    {
    }
}