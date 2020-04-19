<?php

namespace App\Http\Controllers;

use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
    * Instantiate a new UserController instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return ProdutoRepository::search($request);
    }

    public function show($id)
    {
        return ProdutoRepository::get($id);
    }

    public function store(Request $request)
    {
        return ProdutoRepository::save($request->input());
    }

    public function update(Request $request, $id)
    {
        $req = $request->all() + ['id'=>$id];
        return ProdutoRepository::save($req);
    }

    public function destroy($id)
    {
        return ProdutoRepository::delete($id);
    }

    public function destroyMany(Request $request)
    {
        return ProdutoRepository::deleteMany($request);
    }
}
