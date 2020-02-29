@extends('layout.app')

@section('pagetitle')
    <div class="page-title-icon">
        <i class="pe-7s-id bg-tempting-azure">
        </i>
    </div>
    <div>
        Detalhes de Pedidos
        <div class="page-title-subheading">
            Subtítulo de detalhes de Clientes
        </div>
    </div>
@overwrite

@section('content')

        <div class="main-card mb-3 card">
            <div class="card-body">
                @if($section == 'clientes')
                <div class="card-title">Cliente</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-2 alert alert-primary fade show">Nome</div>
                            <div class="alert alert-light fade show">{{ $cliente['nome'] }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 alert alert-primary fade show">Sexo</div>
                            <div class="alert alert-light fade show">{{ $cliente['sexo'] }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 alert alert-primary fade show">Email</div>
                            <div class="alert alert-light fade show">{{ $cliente['email'] }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 alert alert-primary fade show">Telefone</div>
                            <div class="alert alert-light fade show" id="detalheNome">{{ $cliente['telefone'] }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 alert alert-primary fade show">Celular</div>
                            <div class="alert alert-light fade show" id="detalheNome">{{ $cliente['celular'] }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 alert alert-primary fade show">Endereço</div>
                            <div class="alert alert-light fade show" id="detalheNome">
                                {{
                                    $cliente['cep'].' - '.$cliente['cidade'].' ('.$cliente['estado'].'). '.
                                    $cliente['logradouro'].', '.$cliente['numero'].'. '.$cliente['bairo'].'. '.
                                    'Complemento: '.$cliente['complemento']
                                }}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="card-title">Produto</div>
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
                @endif
            </div>
        </div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="card-title">Pedidos</div>

                <div class="row">
                    @foreach ($pedidos as $pedido)

                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 alert alert-primary fade show">Id</div>
                                    <div class="alert alert-light fade show">
                                        <p>
                                            {{ $pedido['id'] }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 alert alert-primary fade show">Data</div>
                                    <div class="alert alert-light fade show">
                                        {{ $pedido['dataCompra'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 alert alert-primary fade show">Status</div>
                                    <div class="alert alert-light fade show">
                                        {{ $pedido['status'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 alert alert-primary fade show">Produto</div>
                                    <div class="alert alert-light fade show">
                                        <p>
                                            {{ $pedido->Produtos['nome'] }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 alert alert-primary fade show">Cliente</div>
                                    <div class="alert alert-light fade show">
                                        <p>
                                            {{ $pedido->Clientes['nome'] }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 alert alert-primary fade show">Quantidade</div>
                                    <div class="alert alert-light fade show">
                                        <p>
                                            {{ $pedido['quantidade'] }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 alert alert-primary fade show">ValorTotal</div>
                                    <div class="alert alert-light fade show">
                                        {{ $pedido['valorTotal'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

</div>

    @overwrite

@section('bodyfooter')
    <script src="{{asset('js/clientes.js')}}"></script>
@overwrite
