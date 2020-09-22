<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        return Produto::all();

        return response()->json();
    }

    public function store(Request $req)
    {
        Produto::create($req->all());
    }

    public function show($id)
    {
        return Produto::findOrFail($id);
    }

    public function update(Request $req, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->update($req->all());
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
    }
}
