@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Listagem de Pedidos <br><a class="btn btn-link float-right"
                                                                         href="{{ route('purchase.create') }}">Cadastrar
                            novo</a></div>
                    <div class="card-body">
                        <form method="get" action="{{ route('purchase.index') }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ID Pedido</label>
                                    <input type="text" class="form-control" name="id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Data</label>
                                    <input type="date" class="form-control" name="created_at">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="">-- selecione --</option>
                                        <option value="Em Aberto">Em Aberto</option>
                                        <option value="Pago">Pago</option>
                                        <option value="Cancelado">Cancelado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="order" class="custom-control-input"
                                       value="created_at">
                                <label class="custom-control-label" for="customRadioInline1">Ordernar por data</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="order" class="custom-control-input"
                                       value="amount">
                                <label class="custom-control-label" for="customRadioInline2">Ou por valor</label>
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Pesquisar</button>
                            </div>
                        </form>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Nome</th>
                                <th>Data Pedido</th>
                                <th>Valor Total</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            @foreach($results as $purchase)
                                <tr class="{{$purchase->status==='Cancelado'?'table-secondary':''}}{{$purchase->status==='Pago'?'table-success':''}}">
                                    <td>{{$purchase->id}}</td>
                                    <td><a href="{{ route('customer.show',$purchase->customer->id) }}" class="btn btn-link">{{$purchase->customer->name}}</a></td>
                                    <td>{{$purchase->created_at->format('d/m/Y H:i')}}</td>
                                    <td>R$ {{number_format($purchase->amount,2,',','')}}</td>
                                    <td>{{$purchase->status}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">
                                                Ação
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu" style="min-width: 140px;">
                                                <li><a href="{{ route('purchase.show',$purchase->id) }}"
                                                       class="btn btn-default">Detalhe</a>
                                                </li>
                                                <li><a href="{{ route('purchase.edit',$purchase->id) }}"
                                                       class="btn btn-default">Editar</a>
                                                </li>
                                                <li>
                                                    <form method="post"
                                                          action="{{ route('purchase.status',$purchase->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Pago">
                                                        <button type="submit" class="btn btn-info btn-block">Pagar</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form method="post"
                                                          action="{{ route('purchase.status',$purchase->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Cancelado">
                                                        <button type="submit" class="btn btn-warning btn-block">Cancelar</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form method="post"
                                                          action="{{ route('purchase.destroy',$purchase->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-block"><span
                                                                class="glyphicon glyphicon-trash"></span>Excluir
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
