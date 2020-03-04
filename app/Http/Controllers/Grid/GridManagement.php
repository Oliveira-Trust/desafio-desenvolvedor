<?php


namespace App\Http\Controllers\Grid;


use App\Models\Client;
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
        $grid->column('id')->classes(['productId'])->title('Id')->sortable(true)->searchable();
        $grid->column('price')->classes(['productPrice'])->title('Preço')->sortable()->searchable();
        $grid->column('name')->classes(['productName'])->title('Nome')->sortable()->searchable();
        $grid->column('ean')->classes(['productEan'])->title('Ean')->sortable()->searchable();
        $grid->column('quantity')->title('Quantidade')->html(
            function(){
                return '<input type="number" name="productQuantity" class="form-group productQuantity" id="productQuantity">';
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

    public static function ClientGrid()
    {

        $grid =  (new OkipaTable)->model(Client::class)->routes([
            'index'   => ['name' => 'clientes']
        ]);
        $grid->column('id')->classes(['id'])->title('Id')->sortable(true)->searchable();
        $grid->column('name')->classes(['name'])->title('Nome')->sortable()->searchable();
        $grid->column('email')->classes(['email'])->title('Email')->sortable()->searchable();

        $grid->column('action')->title('Actions')->html(
            function()
            {
                return '<button class="btn btn-success" id="btnAddCart">Editar</button> <button class="btn btn-danger" id="btnRemvCart">remover</button>';
            }
        );
        return $grid;
    }

}
