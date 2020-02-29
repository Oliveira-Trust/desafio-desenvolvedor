@extends('layout.app')

@section('pagetitle')
    <div class="page-title-icon">
        <i class="pe-7s-id bg-tempting-azure">
        </i>
    </div>
    <div>
        Detalhes de Produtos
        <div class="page-title-subheading">
            Subtítulo de detalhes de Produtos
        </div>
    </div>
@overwrite

@section('content')

        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="card-title">Detalhes</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-2 alert alert-primary fade show">Nome</div>
                            <div class="alert alert-light fade show">{{ $produto['nome'] }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 alert alert-primary fade show">Valor de Compra</div>
                            <div class="alert alert-light fade show">{{ $produto['valorCompra'] }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 alert alert-primary fade show">Valor de Venda</div>
                            <div class="alert alert-light fade show">{{ $produto['valorVenda'] }}</div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2 alert alert-primary fade show">Descrição</div>
                            <div class="alert alert-light fade show">
                                <p>
                                    {{ $produto['descricao'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

    @overwrite

@section('bodyfooter')
    <script src="{{asset('js/clientes.js')}}"></script>
@overwrite
