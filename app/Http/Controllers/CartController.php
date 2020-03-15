<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = session()->get('cart');
        return view('cart.index', compact('items'));
    }

    public function add(Request $request)
    {
        $product = $request->get('product');

        if(session()->has('cart')){

            $products = session()->get('cart');
            $productsIds = array_column($products, 'id');

            if(in_array($product['id'], $productsIds)){
                $products = $this->productIncrement($product['id'], $product['qtd'], $products);

                session()->put('cart', $products);
            }else{
                session()->push('cart', $product);
            }

        }else{
            $products[] = $product;
            session()->put('cart', $products);

        }

        return redirect()->route('cart.index')->with('success', 'Produto Adicionado com succeso no carrinho!');
    }

    public function remove($id)
    {
        if(!session()->has('cart'))
            return redirect()->route('cart.index');

        $products = session()->get('cart');

        $products = array_filter($products, function($line) use($id){
            return $line['id'] != $id;
        });

        session()->put('cart', $products);
        return redirect()->route('cart.index')->with('success', 'Produto removido do carrinho com sucesso!');
    }

    public function cancel()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Carrinho limpo!');
    }

    private function productIncrement($id, $qtd, $products)
    {
        $products = array_map(function($line) use($id, $qtd){
            if($id == $line['id']) {
                $line['qtd'] += $qtd;
            }
            return $line;
        }, $products);

        return $products;
    }
}
