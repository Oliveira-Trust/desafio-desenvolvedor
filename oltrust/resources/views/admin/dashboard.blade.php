@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><i class="fas fa-window-restore"></i> CRUD - Desafio Oliveira Trust</div>

                    <div class="card-body">
                    <p>O desafio consiste em implementar uma aplicação Web utilizando algum framework PHP, e um banco de dados relacional MySQL ou Postgres, a criação das tabelas é livre para sua implementação.</p>
                    <p>Você vai criar uma aplicação de cadastro de pedidos de compra, a partir de uma modelagem inicial, com as seguintes funcionalidades:</p>

                    + CRUD de clientes.<br />
                    + CRUD de produtos.<br />
                    + CRUD de pedidos de compra, com status (Em Aberto, Pago ou Cancelado).<br />
                    + Cada CRUD:<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;- deve ser filtrável e ordenável por qualquer campo.<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;- deve possuir formulários para criação e atualização de seus itens.<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;- deve permitir a deleção de qualquer item de sua lista.<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;- Barra de navegação entre os CRUDs.<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;- Links para os outros CRUDs nas listagens (Ex: link para o detalhe do cliente da compra na lista de pedidos de compra)<br />

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
