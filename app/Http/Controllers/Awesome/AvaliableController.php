<?php

namespace App\Http\Controllers\Awesome;

use App\Http\Controllers\Controller;
use App\Libs\AwesomeApi;
use Illuminate\Http\Request;

class AvaliableController extends Controller
{
    private $awesomeApi;

    public function __construct()
    {
        $this->awesomeApi = new AwesomeApi();
    }

    public function index()
    {
        $avaliables = $this->awesomeApi->getAvaliable();

        return view('index',compact('avaliables'));
    }
}
