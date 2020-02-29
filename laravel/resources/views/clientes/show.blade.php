@extends('layout.app')

@section('pagetitle')
    <div class="page-title-icon">
        <i class="pe-7s-id bg-tempting-azure">
        </i>
    </div>
    <div>
        Detalhes de Clientes
        <div class="page-title-subheading">
            Subtítulo de detalhes de Clientes
        </div>
    </div>
@overwrite

@section('content')

        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="card-title">Detalhes</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
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
                </div>
            </div>
        </div>

</div>

    @overwrite

@section('bodyfooter')
    <script src="{{asset('js/clientes.js')}}"></script>
@overwrite
