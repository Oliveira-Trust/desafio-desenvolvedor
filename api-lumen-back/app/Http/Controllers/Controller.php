<?php

namespace App\Http\Controllers;

use App\Http\Request\FormRequest;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController implements FormRequest
{
    protected $params;
    public $request;

    public function __construct(Request $request)
    {
        $this->params = $request->all();
        $this->request = $request;
    }

    /**
    * Return the Request Object
    *
    * @return \Illuminate\Http\Request
    */
   public function getAll(): Request
   {
      return $this->request->replace($this->params);
   }
}
