<?php

namespace App\Http\Controllers;

use App\MyClass\MagentoApis;
use App\MyClass\Order;
use App\MyClass\Traits\OpenViewController;
use Illuminate\Http\Request;

class MainController extends Controller
{
    use OpenViewController;

    private $title    = 'Inicio';
    private $subtitle;
    private $pathView = 'main';

    public function __construct()
    {

    }

    public function index(){
        $this->subtitle = 'Estatísticas do dia';
        return $this->openView();
    }
}