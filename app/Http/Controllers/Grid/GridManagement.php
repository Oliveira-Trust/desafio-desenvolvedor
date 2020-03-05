<?php


namespace App\Http\Controllers\Grid;


use App\Models\Client;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Products;
use App\User;
use Okipa\LaravelTable\Table as OkipaTable;

class GridManagement
{
    public static function orderGrid()
    {

        $grid =  (new OkipaTable)->model(Products::class)->routes([
            'index'   => ['name' => 'produtos']
        ]);
        $grid->column('id')->title('Id')->sortable(true)->searchable();
        $grid->column('price')->classes(['productPrice'])->title('Preço')->sortable()->searchable();
        $grid->column('name')->classes(['productName'])->title('Nome')->sortable()->searchable();
        $grid->column('ean')->classes(['productEan'])->title('Ean')->sortable()->searchable();
        $grid->column('client')->classes(['productEan'])->title('Cliente')->html(function (){
            $option ="<select name='selectClient' class='form-control' id='selectClient'>";
            $option .= "<option value=''>Escolha um Cliente</option>";
            foreach (Client::all() as $client){
                $option .= "<option value='".$client->id."'>$client->name</option>";
            }
            $option .= "</select>";
            return $option;
        });
        $grid->column('quantity')->title('Quantidade')->html(
            function($product){
                return '<input type="hidden" class="productId" value="'.$product->id.'"><input type="number" name="productQuantity" class="form-control productQuantity" id="productQuantity" min="0">';
            }
        );
        $grid->column('status')->title('Status')->html(
            function(){
                return '
                        <select name="status" class="form-control" id="statusOrder">
                            <option value="'.Order::PEDIDO_ABERTO.'">'.Order::PEDIDO_ABERTO.'</option>
                            <option value="'.Order::PEDIDO_PAGO.'">'.Order::PEDIDO_PAGO.'</option>
                            <option value="'.Order::PEDIDO_CANCELADO.'">'.Order::PEDIDO_CANCELADO.'</option>
                        </select>

                        ';
            }
        );
        $grid->column('action')->title('Actions')->html(
            function()
            {
                return '<button class="btn btn-success" id="btnAddCart">Adicionar</button>';
            }
        );
        return $grid;
    }

    public static function listOrdersGrid()
    {

        $grid =  (new OkipaTable)->model(Order::class)->routes([
            'index'   => ['name' => 'pedidos'],
            'destroy'   => ['name' => 'pedidos.softdelete']
        ]);
        $grid->column('id')->classes(['orderId'])->title('Id')->sortable(true)->searchable();
        $grid->column()->title('Produtos')->link(function($order){
            return route('order.detail', $order->id);
        })->value(function(){
            return "Produtos do Pedido";
        });
        $grid->column()->title('Cliente')->value(function($order){
            return $order->client->name;
        });


        return $grid;
    }

    public static function clientGrid()
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


    public static function productsGrid(){
        $table = (new OkipaTable)->model(Products::class)->routes([
            'index'   => ['name' => 'produtos'],
            'create'  => ['name' => 'produto.cadastrar'],
            'edit'    => ['name' => 'produto.editar'],
            'destroy' => ['name' => 'produto.excluir'],
        ])->destroyConfirmationHtmlAttributes(function (Products $products) {
            return [
                'data-confirm' => 'Are you sure you want to delete the user ' . $products->name . ' ?',
            ];
        });
        $table->column('id')->title('Id')->sortable(true)->searchable();
        $table->column('price')->title('Preço')->sortable()->searchable();
        $table->column('name')->title('Nome')->sortable()->searchable();
        $table->column('ean')->title('Ean')->sortable()->searchable();

        return $table;
    }

}
