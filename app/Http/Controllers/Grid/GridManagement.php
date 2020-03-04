<?php


namespace App\Http\Controllers\Grid;


use App\Models\Client;
use App\Models\Order;
use App\Models\Products;
use App\User;
use Okipa\LaravelTable\Table as OkipaTable;

class GridManagement
{
    public static function OrderGrid()
    {

        $grid =  (new OkipaTable)->model(Products::class)->routes([
            'index'   => ['name' => 'produtos']
        ]);
        $grid->column('id')->title('Id')->sortable(true)->searchable();
        $grid->column('price')->classes(['productPrice'])->title('Preço')->sortable()->searchable();
        $grid->column('name')->classes(['productName'])->title('Nome')->sortable()->searchable();
        $grid->column('ean')->classes(['productEan'])->title('Ean')->sortable()->searchable();
        $grid->column('quantity')->title('Quantidade')->html(
            function($product){
                return '<input type="hidden" class="productId" value="'.$product->id.'"><input type="number" name="productQuantity" class="form-group productQuantity" id="productQuantity">';
            }
        );
        $grid->column('action')->title('Actions')->html(
            function()
            {
                return '<button class="btn btn-success" id="btnAddCart">Adicionar</button> <button class="btn btn-danger" id="btnRemvCart">remover</button>';
            }
        );
        return $grid;
    }

    public static function ListOrdersGrid()
    {

        $grid =  (new OkipaTable)->model(Order::class)->routes([
            'index'   => ['name' => 'pedidos']
        ]);
        $grid->column('id')->classes(['orderId'])->title('Id')->sortable(true)->searchable();
        $grid->column('status')->classes(['orderStatus'])->title('Status')->sortable()->searchable();
        $grid->column()->title('Produtos')->value(function($order){
            $products = [];
            foreach ($order->products as $product) {
                $products[] = $product->product->name;
            }
            return implode(', ', $products);
        });

        return $grid;
    }

    public static function ClientGrid()
    {

        $grid =  (new OkipaTable)->model(Client::class)->routes([
            'index'   => ['name' => 'clientes'],
            'create'  => ['name' => 'cliente.cadastrar'],
            'edit'    => ['name' => 'cliente.editar'],
            'destroy' => ['name' => 'cliente.excluir'],
        ]);
        $grid->column('id')->classes(['id'])->title('Id')->sortable(true)->searchable();
        $grid->column('name')->classes(['name'])->title('Nome')->sortable()->searchable();
        $grid->column('email')->classes(['email'])->title('Email')->sortable()->searchable();

        return $grid;
    }

}
